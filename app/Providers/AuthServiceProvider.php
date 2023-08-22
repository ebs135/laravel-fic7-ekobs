<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	public static $permissions = [
		'dashboard' => ['superadmin', 'admin'],
		'user-index' => ['admin'],
	];

	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		//
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		foreach (self::$permissions as $feature => $roles) {
			Gate::define($feature, function (User $user) use ($roles) {
				if (in_array($user->role, $roles)) {
					return true;
				}
			});
		}
	}
}
