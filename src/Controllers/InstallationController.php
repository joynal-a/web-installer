<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Managers\InstallationManager;

class InstallationController extends Controller
{
    private $manager;
    public function __construct(InstallationManager $permissionManager){
        $this->manager = $permissionManager;
    }
     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        return match($this->isPublish){
            true => view('vendor.web-installer.install'),
            default => view('joynala.web-installer::install')
        };
    }

    
}
