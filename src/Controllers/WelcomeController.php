<?php 

namespace Abedin\WebInstaller\Controllers;

use Exception;

class WelcomeController extends Controller
{
     /**
     * Display the installer welcome page.
     */
    public function welcome()
    {
        return config('install.environment');
        // check vendor is published or not
        $isPublish = is_dir(base_path('resources/views/vendor/web-installer'));
        return match($isPublish){
            true => view('vendor.web-installer.index'),
            default => view('joynala.web-installer::index')
        };
    }
}