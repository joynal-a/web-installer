<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\InstallationTrait;
use Abedin\WebInstaller\Traits\UpdateTrait;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    use UpdateTrait, InstallationTrait;
     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $hasConfigFile = $this->hasConfigFile;
        // check vendor is published or not
        return match($this->isPublish){
            true => view('vendor.web-installer.update.index', compact('hasConfigFile')),
            default => view('joynala.web-installer::update.index', compact('hasConfigFile'))
        };
    }

    public function verifyForm()
    {
        $verifyRules = config('installer.verify_rules');
        return match($this->isPublish){
            true => view('vendor.web-installer.update.verify', compact('verifyRules')),
            default => view('joynala.web-installer::update.verify', compact('verifyRules'))
        };
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
                    $message = 'You are trying to wrong information';
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

    public function uploadFile()
    {
        return match($this->isPublish){
            true => view('vendor.web-installer.update.upload'),
            default => view('joynala.web-installer::update.upload')
        };
    }

    public function updateFile()
    {
        $this->unzipAndStore();
        $filePaths = $this->getFilePath();

        foreach($filePaths as $filePath){
            $mainDir = file($filePath['mainDir']);
            $updatDir = file($filePath['updateDir']);

            // Iterate over the lines and compare
            $numLines = max(count($mainDir), count($updatDir));

            for ($i = 0; $i < $numLines; $i++) {
                $line1 = isset($mainDir[$i]) ? rtrim($mainDir[$i]) : null;
                $line2 = isset($updatDir[$i]) ? rtrim($updatDir[$i]) : null;

                // Check if lines are different
                if ($line1 !== $line2) {
                    file_put_contents($filePath['mainDir'], implode('', $updatDir));
                    break;
                }

            }
        }

        Artisan::call('migrate:fresh', ['--force' => true]);
        shell_exec('composer update');

        return;
    }
}


