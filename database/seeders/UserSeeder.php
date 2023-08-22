<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::create([
			'name' => 'Administrator',
			'email' => 'admin@mail.com',
			'role' => 'admin',
			'phone' => '628123456789',
			'bio' => 'Administrator Bio',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => 'Super Admin',
			'email' => 'superadmin@mail.com',
			'role' => 'superadmin',
			'phone' => '628123456780',
			'bio' => 'Super Admin Bio',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
		]);
		User::factory(23)->create();
	}
}
