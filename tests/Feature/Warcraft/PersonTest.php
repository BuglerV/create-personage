<?php

namespace Tests\Feature\Warcraft;

use Tests\TestCase;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

/**
 * @group warcraft
 * @group person
 */
class PersonTest extends TestCase
{
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_person_page()
	{
		$this->get(route('person.index'))
		     ->assertRedirect(route('login'));
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_person_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('person.index'))
			 ->assertOk();
		
		DB::rollback();
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_create_new_person()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$name = $this->faker()->firstName() . microtime(1);
		
		$this->actingAs($user)
		     ->post(route('person.init'),['name' => $name]);
			 
		$this->assertDatabaseHas('people',[
		    'name' => $name,
		]);
		
		DB::rollback();
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_delete_own_person()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$name = $this->faker()->firstName() . microtime(1);
		
		$this->actingAs($user)
		     ->post(route('person.init'),['name' => $name]);
			 
		$person = Person::where('name',$name)->first();
			 
		$this->actingAs($user)
		     ->delete(route('person.destroy',$person));
			 
		$this->assertModelMissing($person);
		
		DB::rollback();
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_access_not_own_person()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$name = $this->faker()->firstName() . microtime(1);
		
		$this->actingAs($user)
		     ->post(route('person.init'),['name' => $name]);
			 
		$person = Person::where('name',$name)->first();
		
		$user2 = User::factory()->create();
		
		$this->actingAs($user2)
		     ->delete(route('person.destroy',$person));
			 
		$this->assertModelExists($person);
		
		DB::rollback();
	}
	
    /**
	 * Создаем новый экземпляр Faker.
	 *
	 * @return \Faker\Faker 
	 */
	protected function faker()
	{
		return app('Faker\\Factory')->create();
	}
}
