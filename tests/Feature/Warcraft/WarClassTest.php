<?php

namespace Tests\Feature\Warcraft;

use Tests\TestCase;
use App\Models\User;
use App\Models\WarClass;
use Illuminate\Support\Facades\DB;

/**
 * @group warcraft
 * @group warclass
 */
class WarClassTest extends TestCase
{
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_warclass_page()
	{
		$this->get(route('warclass.index'))
		     ->assertRedirect(route('login'));
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_warclass_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('warclass.index'))
			 ->assertOk();
		
		DB::rollback();
		
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_create_new_warclass()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$warclass = WarClass::factory()->raw();
		
		$this->actingAs($user)
		     ->get(route('warclass.create'))
			 ->assertForbidden();
		
		$this->actingAs($user)
		     ->post(route('warclass.store'),$warclass)
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_delete_warclass()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$warclass = WarClass::factory()->create();
		
		$this->actingAs($user)
		     ->delete(route('warclass.destroy',$warclass))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_edit_warclass()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$warclass = WarClass::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('warclass.edit',$warclass))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_restore_warclass()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$warclass = WarClass::factory()->create();
		$warclass->delete();
		
		$this->actingAs($user)
		     ->get(route('warclass.restore',$warclass))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_create_new_warclass()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$warclass = WarClass::factory()->raw();
		
		$this->actingAs($admin)
		     ->get(route('warclass.create'))
			 ->assertOk();
		
		$this->actingAs($admin)
		     ->post(route('warclass.store'),$warclass);
		
		$this->assertDatabaseHas('warcraft_group',[
		    'title' => $warclass['title'],
		]);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_delete_warclass()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$warclass = WarClass::factory()->create();

		$this->actingAs($admin)
		     ->delete(route('warclass.destroy',$warclass));
		
		$this->assertSoftDeleted($warclass);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_edit_warclass()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$warclass = WarClass::factory()->create();

		$this->actingAs($admin)
		     ->get(route('warclass.edit',$warclass))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_restore_warclass()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$warclass = WarClass::factory()->create();
		$warclass->delete();

		$this->actingAs($admin)
		     ->get(route('warclass.restore',$warclass));
			 
		$this->assertNotSoftDeleted($warclass);
		
		DB::rollback();
	}
}
