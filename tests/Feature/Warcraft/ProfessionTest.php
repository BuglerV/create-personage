<?php

namespace Tests\Feature\Warcraft;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;

/**
 * @group warcraft
 * @group profession
 */
class ProfessionTest extends TestCase
{
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_profession_page()
	{
		$this->get(route('profession.index'))
		     ->assertRedirect(route('login'));
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_profession_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('profession.index'))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_create_new_profession()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$profession = Profession::factory()->raw();
		
		$this->actingAs($user)
		     ->get(route('profession.create'))
			 ->assertForbidden();
		
		$this->actingAs($user)
		     ->post(route('profession.store'),$profession)
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_delete_profession()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$profession = Profession::factory()->create();
		
		$this->actingAs($user)
		     ->delete(route('profession.destroy',$profession))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_edit_profession()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$profession = Profession::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('profession.edit',$profession))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_restore_profession()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$profession = Profession::factory()->create();
		$profession->delete();
		
		$this->actingAs($user)
		     ->get(route('profession.restore',$profession))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_create_new_profession()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$profession = Profession::factory()->raw();
		
		$this->actingAs($admin)
		     ->get(route('profession.create'))
			 ->assertOk();
		
		$this->actingAs($admin)
		     ->post(route('profession.store'),$profession);
		
		$this->assertDatabaseHas('warcraft_group',[
		    'title' => $profession['title'],
		]);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_delete_profession()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$profession = Profession::factory()->create();

		$this->actingAs($admin)
		     ->delete(route('profession.destroy',$profession));
		
		$this->assertSoftDeleted($profession);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_edit_profession()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$profession = Profession::factory()->create();

		$this->actingAs($admin)
		     ->get(route('profession.edit',$profession))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_restore_profession()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$profession = Profession::factory()->create();
		$profession->delete();

		$this->actingAs($admin)
		     ->get(route('profession.restore',$profession));
			 
		$this->assertNotSoftDeleted($profession);
		
		DB::rollback();
	}
}
