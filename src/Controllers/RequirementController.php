<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Lib\Managers\RequirementManager;

class RequirementController extends Controller
{
    private $manager;
    public function __construct(RequirementManager $requirementManager){
        $this->manager = $requirementManager;
    }
     /**
     * Display the installer requirement page.
     */
    public function index()
    {
        $phpSupportInfo = $this->manager->checkPHPversion(config('installer.minPhpVersion'));
        $extensions = $this->manager->check(config('installer.php_extensions'));

        return match($this->isPublish){
            true => view('vendor.web-installer.requirement', compact('phpSupportInfo', 'extensions')),
            default => view('joynala.web-installer::requirement', compact('phpSupportInfo', 'extensions'))
        };
    }
}
