<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'publish product']);
        Permission::create(['name' => 'unpublish product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'buy product']);


        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view product');
        $adminRole->givePermissionTo('create product');
        $adminRole->givePermissionTo('edit product');
        $adminRole->givePermissionTo('delete product');
        $adminRole->givePermissionTo('publish product');
        $adminRole->givePermissionTo('unpublish product');

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('view product');
        $userRole->givePermissionTo('buy product');


        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('view product');
        $userRole->givePermissionTo('buy product');


        $superadminRole = Role::create(['name' => 'super-admin']);


        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@tongsus.id',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($userRole);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@tongsus.id',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);


        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@tongsus.id',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($owneRole);
    }
}
