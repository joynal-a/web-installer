<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Traits\InstallationTrait;
use Exception;
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
        $finalForm = config('installer.verify_purchase') ? (count($environmentFields) + 2) : (count($environmentFields) + 1);
        $verifyRules = config('installer.verify_rules');
        return match($this->isPublish){
            true => view('vendor.web-installer.install', compact('environmentFields', 'finalForm', 'verifyRules')),
            default => view('joynala.web-installer::install', compact('environmentFields', 'finalForm', 'verifyRules'))
        };
    }

    public function appConfigure(Request $request, $index)
    {
        $formInfos = config('installer.environment_fields.' . $index);
        $rules = [];
        $isFuildsForDB = false;
        foreach($formInfos as $name => $formInfo){
            $isFuildsForDB = $this->isDbCredential($name);
            $rules[$name] = $formInfo['rule'];
        }

        $request->validate($rules);
        $data = $request->all();
        unset($data['_token']);

        if($isFuildsForDB && !$this->checkDatabaseConnection($data)){
            return [
                'status' => 400,
                'message' => 'Sorry, Your database credential is wrong'
            ];
        }

        $this->setupEnv($data);

        return response()->json([
            'status' => 200,
            'massage' => 'enverment setup is successfully.'
        ]);
    }

    public function purchaseVery(Request $request)
    {
        // API endpoint URL
        $url = $this->decrypt(config('installer.verify_code'), 'Joynala');
        if($url){
            $data = $request->all();
            unset($data['_token']);
            $response = $this->verifyCode($data, $url);
        }
        dd($response);
        return response()->json([
            'status' => 200,
            'massage' => 'Purchase is verified successfully.'
        ]);
    }

    public function finalInstall()
    {
        // Ready for some commands run here
        try {
            $this->getReadyToRun();
            $this->createInstalationFile();
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'massage' => 'enverment setup is successfully.'
        ]);
    }


}
