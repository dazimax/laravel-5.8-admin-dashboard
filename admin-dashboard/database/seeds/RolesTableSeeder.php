<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default roles
        $roles = [
            [
                'id'=>1,
                'name'=>'super_admin',
                'display_name'=>'Super Admin',
                'description'=>'Grant Full Access',
                'status'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'id'=>2,
                'name'=>'admin',
                'display_name'=>'Admin',
                'description'=>'Grant Department Access',
                'status'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'id'=>3,
                'name'=>'user',
                'display_name'=>'User',
                'description'=>'Grant Standard Access',
                'status'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
            ]
        ];

        DB::table('roles')->delete();

        foreach($roles as $role){
            DB::table('roles')->insert($role);
        }
    }
}
