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
        User::truncate();  
        DB::table('role_user')->truncate();  // Used for Fakers generated by the Factory 
        
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name' , 'author')->first();
        $userRole = Role::where('name' , 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $author = User::create([
            'name' => 'Author',
            'email' => 'author@author.com',
            'password' => bcrypt('author')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user')
        ]);

        /* Attaching the ID */
        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);

        /* JUST RUN -> $ php artisan db:seed */
        factory(App\User::class, 50)->create();  //  This will generate 50 fakers on Users table

    }
}
