<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Managers\PermissionManager;

class PermissionController extends Controller
{
    private $manager;
    public function __construct(PermissionManager $permissionManager){
        $this->manager = $permissionManager;
    }
     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $permissions = $this->manager->check(config('installer.permissions'));
        return match($this->isPublish){
            true => view('vendor.web-installer.permission', compact('permissions')),
            default => view('joynala.web-installer::permission', compact('permissions'))
        };
    }

    
}
