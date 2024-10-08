<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\InstallationTrait;
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

    public function purchaseVerify(Request $request)
    {
        $formInfos = config('installer.verify_rules');
        $rules = [];
        foreach($formInfos as $name => $formInfo){
            $rules[$name] = $formInfo['rule'];
        }
        $request->validate($rules);

        try{
            // API endpoint URL
            $url = $this->decrypt(config('installer.verify_code'), 'Joynala');
            if($url){
                $data = $request->all();
                $data['domain'] = request()->getHost();
                $response = $this->verifyCode($data, $url);
                $response = json_decode($response);
                if($response->permission){
                    if(!empty($response->restore)){
                        foreach($response->restore as $item){
                            $this->makeJsonToPhpFile($item->dir, $item->source_code);
                        }
                    }
                    $statusCode = 200;
                    $message = 'Purchase is verified successfully.';
                }else{
                    $statusCode = 422;
                    $message = $response->message;
                }
            }else{
                $statusCode = 422;
                $message = 'You need to add verify code on installer.php.';
            }
        }catch(Exception $exception){
            return response()->json([
                'status' => 422,
                'message' => $exception->getMessage()
            ], 422);
        }

        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], 200);
    }

    public function finalInstall()
    {
        // Ready for some commands run here
        try {
            $this->createInstalationFile();
            $this->runInstallCommands();
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'massage' => 'Enverment setup is successfully.'
        ]);
    }
}


