<?php

namespace Abedin\WebInstaller\Controllers;

class Controller
{

    /**
     * @property bool $isPublish
     * check the views is publis or not
     */
    public $isPublish = false;
    /**
     * @property bool $hasConfigFile
     * check has config files (installer.php) is exists or not
     */
    public $hasConfigFile = false;

    /**
     * assign bool which i check
     * @property $hasConfigFile | $isPublish
     */
    public function __construct()
    {
        $this->isPublish = is_dir(base_path('resources/views/vendor/web-installer'));
        $this->hasConfigFile = is_file( base_path('config/installer.php'));
    }
}
