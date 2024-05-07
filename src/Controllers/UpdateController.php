<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\InstallationTrait;
use Exception;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    use InstallationTrait;
     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $hasConfigFile = $this->hasConfigFile;
        // check vendor is published or not
        return match($this->isPublish){
            true => view('vendor.web-installer.update.index', compact('hasConfigFile')),
            default => view('joynala.web-installer::update.index', compact('hasConfigFile'))
        };
    }

    public function purchaseVerify()
    {
        $verifyRules = config('installer.verify_rules');
        return match($this->isPublish){
            true => view('vendor.web-installer.update.verify', compact('verifyRules')),
            default => view('joynala.web-installer::update.verify', compact('verifyRules'))
        };
    }
}


