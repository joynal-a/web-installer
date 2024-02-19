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
        $hasConfigFile = is_file( base_path('config/installer.php'));
        // check vendor is published or not
        $isPublish = is_dir(base_path('resources/views/vendor/web-installer'));
        return match($isPublish){
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