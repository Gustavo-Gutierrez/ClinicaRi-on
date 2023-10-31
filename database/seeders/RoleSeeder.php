<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Comerciante']);
        $role3 = Role::create(['name' => 'Almacenador']);
        $role4 = Role::create(['name' => 'Supervisor']);
        $role5 = Role::create(['name' => 'RRHH']);
        $role6 = Role::create(['name' => 'Marketing']);

        
        Permission::create(['name' => 'roles.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.update'])->syncRoles([$role1]);
  

      
    }
}
