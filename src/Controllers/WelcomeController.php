<?php 

namespace Abedin\WebInstaller\Controllers;

use Exception;

class WelcomeController extends Controller
{
     /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('joynala.web-installer::index');
    }
}