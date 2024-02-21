<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Traits\InstallationTrait;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    use InstallationTrait;
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

        $data = $request->all();
        // unset($data['_token']);

        $this->setupEnv($data);

        return response()->json([
            'status' => 200,
            'massage' => 'enverment setup is successfully.'
        ]);
    }


}
