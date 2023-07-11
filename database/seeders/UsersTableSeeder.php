<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $AdminRoles = Role::where('name','Quản Trị')->first();
        $userRoles = Role::where('name','Thủ Thư')->first();

        $admin = Admin::create([
            'admin_name' => 'Quản Trị Admin',
            'admin_email' => 'nguyenanhthu55138@gmail.com',
            'admin_phone' => '0395245117',
            'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
            'admin_name' => 'Nguyễn Anh Thư',
            'admin_email' => 'nguyenanhthu55138@gmail.com',
            'admin_phone' => '0395245117',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($AdminRoles);
        $user->roles()->attach($userRoles);
    }
}
