<?php

namespace Abedin\WebInstaller\Controllers;

class RequirementController extends Controller
{
    private $minPhpVersion = '8.0.0';

     /**
     * Display the installer requirement page.
     */
    public function index()
    {
        $phpSupportInfo = $this->checkPHPversion(config('installer.minPhpVersion'));
        $extensions = $this->check(config('installer.php_extensions'));

        return match($this->isPublish){
            true => view('vendor.web-installer.requirment', compact('phpSupportInfo', 'extensions')),
            default => view('joynala.web-installer::requirment', compact('phpSupportInfo', 'extensions'))
        };
    }

    /**
     * Check server requirements.
     *
     * @param array $requirements
     * @return array
     */
    public function check(array $requirements): array
    {
        $results = [
            'requirements' => [],
            'next' => true
        ];

        foreach ($requirements as $requirement) {
            $results['requirements'][$requirement] = true;

            if (! extension_loaded($requirement)) {
                $results['requirements'][$requirement] = false;
                $results['next'] = false;
            }
        }

        return $results;
    }

    /**
     * Check PHP version requirement.
     * @return array
     */
    public function checkPHPversion(string $minPhpVersion = null): array
    {
        $minPhpVersion = $minPhpVersion ?? $this->minPhpVersion;
        $currentPhpVersion = $this->getPhpVersionInfo();
        $status = false;

        if (version_compare($currentPhpVersion['current'], $minPhpVersion) >= 0) {
            $status = true;
        }

        $phpStatus = [
            'last' => $currentPhpVersion['last'],
            'current' => $currentPhpVersion['current'],
            'minimum' => $minPhpVersion,
            'status' => $status,
        ];

        return $phpStatus;
    }

    /**
     * Get current Php version information.
     *
     * @return array
     */
    private static function getPhpVersionInfo(): array
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'last' => $currentVersionFull,
            'current' => $currentVersion,
        ];
    }
}
