<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\RequirementTrait;

class RequirementController extends Controller
{
    use RequirementTrait;

     /**
     * Display the installer requirement page.
     */
    public function index()
    {
        $phpSupportInfo = $this->checkPHPversion(config('installer.minPhpVersion'));
        $extensions = $this->check(config('installer.php_extensions'));

        return match($this->isPublish){
            true => view('vendor.web-installer.requirement', compact('phpSupportInfo', 'extensions')),
            default => view('joynala.web-installer::requirement', compact('phpSupportInfo', 'extensions'))
        };
    }
}
