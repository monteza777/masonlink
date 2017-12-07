<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
   	$role_user = Role::where('name', 'User')->first();
   	$role_disSecretary = Role::where('name', 'District Secretary')->first();
   	$role_admin = Role::where('name', 'Admin')->first();

    $user = new User();
    $user->firstname = 'Kristian';
    $user->lastname = 'Dela Cruz';
    $user->email = 'kristian@gmail.com';
    $user->password = bcrypt('1234567');
    $user->save();
    $user->roles()->attach($role_user);

    $disSecretary = new User();
    $disSecretary->firstname = 'Marlon';
    $disSecretary->lastname = 'Doria';
    $disSecretary->email = 'doria@gmail.com';
    $disSecretary->password = bcrypt('1234567');
    $disSecretary->save();
    $disSecretary->roles()->attach($role_disSecretary); 


    $admin = new User();
    $admin->firstname = 'Oliver';
    $admin->lastname = 'Anastacio';
    $admin->email = 'oliver@gmail.com';
    $admin->password = bcrypt('1234567');		
    $admin->save();
    $admin->roles()->attach($role_admin);
    }
}
