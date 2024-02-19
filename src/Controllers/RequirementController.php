<?php

namespace Abedin\WebInstaller\Controllers;

class RequirementController extends Controller
{
     /**
     * Display the installer requirement page.
     */
    public function index()
    {
        return match($this->isPublish){
            true => view('vendor.web-installer.requirement'),
            default => view('joynala.web-installer::requirement')
        };
    }
}
