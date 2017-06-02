<?php

namespace App\Providers;

use App\Robot;
use App\Policies\RobotPolicy;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     * tableau des classes définissant les poliques d'accès à vos ressources
     */
    protected $policies = [
        Robot::class => RobotPolicy::class
    ];


    public function boot()
    {
        $this->registerPolicies();

         /*
            Gate::define('destroy', function($user, $robot){
        
            if($user->isAdmin()) return true;
            
            return false;
        
            });
            
         */
    }

}
