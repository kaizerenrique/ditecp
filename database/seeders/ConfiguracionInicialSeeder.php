<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConfiguracionInicialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles del Sistema
        $admin = Role::create(['name' => 'Administrador']); //Administrador del Sistema
        $user = Role::create(['name' => 'Usuario']); //Usuario Final

        //Permisos del Sistema
        Permission::create(['name' => 'MenuAdministracion'])->syncRoles([$admin]);

        //usuarios
        $useradmin = User::where('email','kayserenrique@gmail.com')->first();
        if ($useradmin) {
            $useradmin->delete();
        }

        $useradmin = User::create([
            'name' => 'Oliver Gomez',
            'email' => 'kayserenrique@gmail.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-09-01 13:03:29'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Dayana Martinez',
            'email' => 'dmaro006@gmail.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-09-01 13:03:29'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Odennis Quiroz',
            'email' => 'ohaymard@gmail.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('Usuario');        
    }
}
