<?php 

namespace Abedin\WebInstaller\Controllers;

use Illuminate\Support\Facades\Artisan;

class WelcomeController extends Controller
{
     /**
     * Display the installer welcome page.
     */
    public function index()
    {
        $hasConfigFile = $this->hasConfigFile;
        // check vendor is published or not
        
        return match($this->isPublish){
            true => view('vendor.web-installer.index', compact('hasConfigFile')),
            default => view('joynala.web-installer::index', compact('hasConfigFile'))
        };
    }

    public function publishConfig()
    {
        Artisan::call('vendor:publish --tag=web-installer-config');
        return back();
    }
}