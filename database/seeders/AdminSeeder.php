<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminSeeder extends Seeder
{

    const PERMISSIONS = [
        // * roles permission
        "role" => [
            'role.read', 'role.read-write',
        ],
        // * permission permission
        "permission" => [
            'permission.read', 'permission.read-write',
        ],
        // * customers
        "customer" => [
            'customer.read', 'customer.read-write'
        ],
        // * buildings
        "building" => [
            'building.read', 'building.read-write'
        ],
        "insurance" => [
            'insurance.read', 'insurance.read-write', 'insurance.approve'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // * Create permission
        foreach (self::PERMISSIONS as $permissions) {
            foreach ($permissions as $permission) {
                Permission::create([
                    "name" => $permission,
                    'guard_name' => 'web'
                ]);
            }
        }

        // * create super admin roles
        $superAdminRole = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdminRole->givePermissionTo(Permission::all());

        $superAdmin = User::factory()->create([
            "name" => "super-admin",
            "email" => "super.admin@mail.com"
        ]);
        $superAdmin->assignRole($superAdminRole);

        // * marketing roles
        $marketingRole = Role::create([
            'name' => 'marketing',
            'guard_name' => 'web'
        ]);
        $marketingRole->givePermissionTo([
            'customer.read', 'building.read-write'
        ]);

        $marketing = User::factory()->create([
            "name" => "marketing",
            "email" => "marketing@mail.com"
        ]);
        $marketing->assignRole($marketingRole);

        // * admin support roles
        $adminSupportRole = Role::create([
            'name' => 'admin-support',
            'guard_name' => 'web'
        ]);
        $adminSupportRole->givePermissionTo([
            'building.read-write', 'building.read-write'
        ]);

        $adminSupport = User::factory()->create([
            "name" => "admin-support",
            "email" => "admin.support@mail.com"
        ]);
        $adminSupport->assignRole($adminSupportRole);

        // * pincab roles
        $pincabRole = Role::create([
            'name' => 'pincab',
            'guard_name' => 'web'
        ]);
        $pincabRole->givePermissionTo([
            'insurance.read', 'insurance.read-write', 'insurance.approve'
        ]);

        $pincab = User::factory()->create([
            "name" => "pincab",
            "email" => "pincab@mail.com"
        ]);
        $pincab->assignRole($pincabRole);
    }
}
