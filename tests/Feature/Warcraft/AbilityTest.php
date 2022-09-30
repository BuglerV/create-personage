<?php

namespace Tests\Feature\Warcraft;

use Tests\TestCase;
use App\Models\User;
use App\Models\Race;
use App\Models\Ability;
use Illuminate\Support\Facades\DB;

/**
 * @group warcraft
 * @group ability
 */
class AbilityTest extends TestCase
{
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_ability_page()
	{
		$group = Race::factory()->create();
		
		$this->get(route('ability.index',$group))
		     ->assertRedirect(route('login'));
	}
	
    /**
	 * @test
	 *
	 * @group guest
	 */
	public function guest_cant_load_abilities_page()
	{
		$this->get(route('ability.list'))
		     ->assertRedirect(route('login'));
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_ability_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$group = Race::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('ability.index',$group))
			 ->assertOk();
		
		DB::rollback();
	}

    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_can_load_abilities_page()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('ability.list'))
			 ->assertOk();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_create_new_ability()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$group = Race::factory()->create();
		
		$this->actingAs($user)
		     ->get(route('ability.create',$group))
			 ->assertForbidden();
			 
		$ability = Ability::factory()->raw();
		
		$this->actingAs($user)
		     ->post(route('ability.store',$group),$ability)
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_delete_ability()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$group = Race::factory()->create();
		$ability = $this->createAbility($group);
		
		$this->actingAs($user)
		     ->delete(route('ability.destroy',[$group,$ability]))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group user
	 */
	public function user_cant_edit_ability()
	{
		DB::beginTransaction();
		
		$user = User::factory()->create();
		$group = Race::factory()->create();
		$ability = $this->createAbility($group);
		
		$this->actingAs($user)
		     ->get(route('ability.edit',[$group,$ability]))
			 ->assertForbidden();
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_create_new_ability()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$group = Race::factory()->create();
		$ability = Ability::factory()->raw();
		
		$this->actingAs($admin)
		     ->get(route('ability.create',$group))
			 ->assertOk();
		
		$this->actingAs($admin)
		     ->post(route('ability.store',$group),$ability);
		
		$this->assertDatabaseHas('abilities_warcraft',[
		    'title' => $ability['title'],
		]);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_delete_ability()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$group = Race::factory()->create();
		$ability = $this->createAbility($group);

		$this->actingAs($admin)
		     ->delete(route('ability.destroy',[$group,$ability]));
		
		$this->assertModelMissing($ability);
		
		DB::rollback();
	}
	
    /**
	 * @test
	 *
	 * @group admin
	 */
	public function admin_can_edit_ability()
	{
		DB::beginTransaction();
		
		$admin = User::factory()->create(['is_admin' => true]);
		$group = Race::factory()->create();
		$ability = $this->createAbility($group);

		$this->actingAs($admin)
		     ->get(route('ability.edit',[$group,$ability]))
			 ->assertOk();
		
		DB::rollback();
	}
	
	protected function createAbility($group)
	{
		return Ability::factory()->create([
		    'feature_id' => $group->id,
		    'feature_type' => $group->group_type,
		]);
	}
}
