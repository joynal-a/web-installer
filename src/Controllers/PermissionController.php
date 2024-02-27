<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\PermissionTrait;

class PermissionController extends Controller
{
    use PermissionTrait;

     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $permissions = $this->check(config('installer.permissions'));
        return match($this->isPublish){
            true => view('vendor.web-installer.permission', compact('permissions')),
            default => view('joynala.web-installer::permission', compact('permissions'))
        };
    }

    
}
