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
        try{
            return view('vendor.installer.index');
        }catch(Exception $e){
            return view('index');
        }
    }
}