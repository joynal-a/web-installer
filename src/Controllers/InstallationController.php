<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Managers\InstallationManager;

class InstallationController extends Controller
{
    private $manager;
    public function __construct(InstallationManager $installationManager){
        $this->manager = $installationManager;
    }
     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $environmentFields = config('installer.environment_fields');
        return match($this->isPublish){
            true => view('vendor.web-installer.install', compact('environmentFields')),
            default => view('joynala.web-installer::install', compact('environmentFields'))
        };
    }


}
