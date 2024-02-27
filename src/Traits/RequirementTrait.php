<?php

namespace Abedin\WebInstaller\Traits;

trait RequirementTrait 
{
     /**
     * @var string
     */
    private $minPhpVersion = '8.0.0';

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

