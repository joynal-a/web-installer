<?php

namespace Abedin\WebInstaller\Controllers;

use Abedin\WebInstaller\Traits\PermissionTrait;

class PermissionController extends Controller
{
    use PermissionTrait;

     /**
     * Display the instalation permission page.
     */
    public function index()
    {
        $permissions = $this->check(config('installer.permissions'));
        $shellExecEnabled = $this->is_shell_exec_enabled();
        return match($this->isPublish){
            true => view('vendor.web-installer.permission', compact('permissions', 'shellExecEnabled')),
            default => view('joynala.web-installer::permission', compact('permissions', 'shellExecEnabled'))
        };
    }

    function is_shell_exec_enabled()
    {
        $disabled = explode(',', ini_get('disable_functions'));
        $disabled = array_map('trim', $disabled);

        return !in_array('shell_exec', $disabled);
    }

}
