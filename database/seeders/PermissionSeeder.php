<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions =[
            "users.viewAny",
            "users.view",
            "users.create",
            "users.update",
            "users.delete",
            "users.restore",
            "users.forceDelete",
            "permissions.viewAny",
            "permissions.view",
            "permissions.create",
            "permissions.update",
            "permissions.delete",
            "permissions.restore",
            "permissions.forceDelete",
            "roles.viewAny",
            "roles.view",
            "roles.create",
            "roles.update",
            "roles.delete",
            "roles.restore",
            "roles.forceDelete",
        ];
        $user = User::create([
            "name"=>"Administrator",
            "email"=>"admin@filakube.com",
            "password"=>Hash::make("12345678"),
        ]);

        $role = Role::create(["name"=>"admin"]);
        $user->assignRole($role);

        foreach ($permissions as $perm){
            $permission = Permission::create([
                "name"=>$perm,
            ]);
            $permission->assignRole($role);
        }
    }
}
