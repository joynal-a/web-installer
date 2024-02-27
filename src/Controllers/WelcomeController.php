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
        $items = config('installer.need_to_know');
        // check vendor is published or not

        return match($this->isPublish){
            true => view('vendor.web-installer.index', compact('hasConfigFile', 'items')),
            default => view('joynala.web-installer::index', compact('hasConfigFile', 'items'))
        };
    }

    public function publishConfig()
    {
        Artisan::call('vendor:publish --tag=web-installer-config');
        return back();
    }
}