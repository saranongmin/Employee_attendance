<?php

namespace App\Providers;
use App\EmployeeProfile;

use App\Policies\EmployeePolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
                User::class => UserPolicy::class,
      CompanyProfile::class =>CompanyPolicy::class,
      OfferLetter::class=>OfferPolicy::class,
      EmployeeProfile::class =>EmployeePolicy::class,
      Attendance::class =>AttendancePolicy::class,
      Credential::class => CredentialPolicy::class,
      EmployeeProfile::class=>ProfilePolicy::class,
      Hr::class=>HrPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::resource('company-profiles','App\Policies\CompanyPolicy');
        Gate::define('viewAny','
            App\Policies\OfferPolicy@viewAny');
        Gate::resource('profiles','
            App\Policies\ProfilePolicy');
        Gate::define('viewAny','
            App\Policies\AttendancePolicy@viewAny');
        Gate::define('create','
            App\Policies\AttendancePolicy@create');
        Gate::define('view', '
            App\Policies\AttendancePolicy@view');
     Gate::define('viewAny','
            App\Policies\HrPolicy@viewAny');   
                 Gate::define('delete()','
            App\Policies\AttendancePolicy@delete()');

        Gate::define('update()','
            App\Policies\AttendancePolicy@update()');
        Gate::define('viewAny','App\Policies\CredentialPolicy@viewAny');
     Gate::define('create','
            App\Policies\CredentialPolicy@create');
        Gate::define('viewAny','App\Policies\EmployeePolicy@viewAny');
        Gate::define('create', 'App\Policies\EmployeePolicy@create');
        //
    }
}
