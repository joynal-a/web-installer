<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\InstallationTrait;
use Abedin\WebInstaller\Traits\UpdateTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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
                $data['domain'] = request()->getHost();
                $response = $this->verifyCode($data, $url);
                $response = json_decode($response);
                if($response->permission){
                    if(!empty($response->restore)){
                        foreach($response->restore as $item){
                            $this->makeJsonToPhpFile($item->dir, $item->source_code);
                        }
                    }
                    return redirect()->route('updater.file-upload')->with('success', 'Purchase is verified successfully');
                }else{
                    return back()->with('error', $response->message);
                }
            }else{
                return back()->with('error', 'You need to add verify code on installer.php.');
            }
        }catch(Exception $exception){
            return back()->with('error', 'You have provided incorrect information');
        }
    }

    public function uploadFile()
    {
        return match($this->isPublish){
            true => view('vendor.web-installer.update.upload'),
            default => view('joynala.web-installer::update.upload')
        };
    }

    public function updateFile(Request $request)
    {
        $request->validate(['zip' => 'required|mimes:zip']);
        $this->unzipAndStore();
        $filePaths = $this->getFilePath();

        foreach($filePaths as $filePath){
            try{
                if(file_exists(($filePath['mainDir']))){
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
                }else{
                    $directories = explode('/', $filePath['dir']);
                    $dir = base_path();
                    end($directories);
                    $lastIndex = key($directories);
                    foreach($directories as $key => $directory){
                        $dir .= '/' . $directory;
                        if(!is_dir($dir) && $lastIndex > $key){
                            mkdir($dir);
                        }
                    }
                    copy($filePath['updateDir'], $filePath['mainDir']);
                }
            }catch(Exception $e){}
            
        }

        Artisan::call('migrate', ['--force' => true]);

        $this->runUpdateCommands();
        shell_exec('rm -r ' . storage_path('app/public/update'));
        return;

    }
}


