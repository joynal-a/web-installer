<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Managers\InstallationManager;
use Illuminate\Http\Request;

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

    public function appConfigure(Request $request, $index)
    {
        $formInfos = config('installer.environment_fields.' . $index);
        $rules = [];
        foreach($formInfos as $name => $formInfo){
            $rules[$name] = $formInfo['rule'];
        }

        $request->validate($rules);

        return response()->json([
            'status' => 200,
            'massage' => 'enverment setup is successfully.'
        ]);
    }


}
