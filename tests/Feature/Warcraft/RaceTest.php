<?php

namespace Tests\Feature\Warcraft;

use Tests\TestCase;
use App\Models\User;
use App\Models\Race;
use Illuminate\Support\Facades\DB;

/**
 * @group warcraft
 * @group race
 */
class RaceTest extends TestCase
{
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_race_page()
	{
		$this->get(route('race.index'))
		     ->assertRedirect(route('login'));
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_race_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('race.index'))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_create_new_race()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$race = Race::factory()->raw();
		
		$this->actingAs($user)
		     ->get(route('race.create'))
			 ->assertForbidden();
		
		$this->actingAs($user)
		     ->post(route('race.store'),$race)
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_delete_race()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$race = Race::factory()->create();
		
		$this->actingAs($user)
		     ->delete(route('race.destroy',$race))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_edit_race()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$race = Race::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('race.edit',$race))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_restore_race()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$race = Race::factory()->create();
		$race->delete();
		
		$this->actingAs($user)
		     ->get(route('race.restore',$race))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_create_new_race()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$race = Race::factory()->raw();
		
		$this->actingAs($admin)
		     ->get(route('race.create'))
			 ->assertOk();
		
		$this->actingAs($admin)
		     ->post(route('race.store'),$race);
		
		$this->assertDatabaseHas('warcraft_group',[
		    'title' => $race['title'],
		]);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_delete_race()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$race = Race::factory()->create();

		$this->actingAs($admin)
		     ->delete(route('race.destroy',$race));
		
		$this->assertSoftDeleted($race);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_edit_race()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$race = Race::factory()->create();

		$this->actingAs($admin)
		     ->get(route('race.edit',$race))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_restore_race()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$race = Race::factory()->create();
		$race->delete();

		$this->actingAs($admin)
		     ->get(route('race.restore',$race));
			 
		$this->assertNotSoftDeleted($race);
		
		DB::rollback();
	}
}
