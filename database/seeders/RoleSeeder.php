<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        // Admin -> CRUD, usuarios, proyectos, criterios, ALl
        // Cliente -> CRUD, proyectos, requisitos, pruebas, evaluaciones

        $admin = Role::create(['name' => 'admin']);
        $cliente = Role::create(['name' => 'cliente']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$admin, $cliente]);

        Permission::create(['name' => 'users.index'])->assignRole($admin);
        Permission::create(['name' => 'users.create'])->assignRole($admin);
        Permission::create(['name' => 'users.store'])->assignRole($admin);
        Permission::create(['name' => 'users.show'])->assignRole($admin);
        Permission::create(['name' => 'users.edit'])->assignRole($admin);
        Permission::create(['name' => 'users.update'])->assignRole($admin);
        Permission::create(['name' => 'users.destroy'])->assignRole($admin);

        Permission::create(['name' => 'criterios.index']);
        Permission::create(['name' => 'criterios.create']);
        Permission::create(['name' => 'criterios.store']);
        Permission::create(['name' => 'criterios.show']);
        Permission::create(['name' => 'criterios.edit']);
        Permission::create(['name' => 'criterios.update']);
        Permission::create(['name' => 'criterios.destroy']);

        Permission::create(['name' => 'proyectos.index'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.create'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.store'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.show'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.edit'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.update'])->syncRoles([$cliente]);
        Permission::create(['name' => 'proyectos.destroy'])->syncRoles([$cliente]);
    }
}
