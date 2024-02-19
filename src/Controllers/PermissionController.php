<?php

namespace Abedin\WebInstaller\Controllers;

class PermissionController extends Controller
{
     /**
     * Display the installer welcome page.
     */
    public function index()
    {
        return match($this->isPublish){
            true => view('vendor.web-installer.permission', compact('hasConfigFile')),
            default => view('joynala.web-installer::permission', compact('hasConfigFile'))
        };
    }
}
