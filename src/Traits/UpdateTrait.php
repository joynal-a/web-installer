<?php

namespace Abedin\WebInstaller\Traits;

use ZipArchive;

trait UpdateTrait
{
    /**
     * get stored after upload
     * @param array $filePath
     */
    private $filePath = [];

    /**
     * noted all files which ignored
     * @param array $ignoreFiles
     */
    private $ignoreFiles = ['.', '..', '.DS_Store', '.gitignore', '.htaccess', 'favicon.ico', 'robots.txt', '.env', 'framework', 'storage'];

    /**
     * name of dir which file uplod and divide
     * @param array $mainDir
     */
    private $mainDir = 'update';

    /**
     * unzip uploaded file and store in storage directory.
     * @return void
     */
    public function unzipAndStore(): void
    {
        $tempFile = $_FILES['zip']['tmp_name'];
        $dir = storage_path('app/public/');

        $zip = new ZipArchive;

        if ($zip->open($tempFile) === TRUE) {
            // Extract files
            $zip->extractTo($dir);
            // Close the zip file
            $zip->close();
        }
    }

    public function getFilePath(): array
    {
        $destination = storage_path('app/public/' . $this->mainDir);
        $directory = scandir($destination);
        $existsdir = array_diff($directory, $this->ignoreFiles);

        foreach($existsdir as $dirOrFile){
            $dir = $destination .'/'. $dirOrFile;
            if (is_dir($dir)) {
                $this->firstScan($dir);
            } else {
                if($dirOrFile != 'AppServiceProvider.php' && $dirOrFile != 'RouteServiceProvider.php' &&  $dirOrFile != 'BroadcastServiceProvider.php'){
                    $this->filePath[] = $dir;
                }
            }
        }

        return $this->dividePath();
    }

    /**
     * @return void
     * Note: This method is only for additonal commands.
     */
    public function runUpdateCommands(): void
    {
        $commands = config('installer.update_commands');
        $changeToBasePath = 'cd ' . base_path();
        foreach($commands as $command){
            shell_exec($changeToBasePath . ' && ' . $command);
        }
    }

    private function dividePath(): array
    {
        $data = [];
        foreach($this->filePath as $path){
            $divide = explode($this->mainDir, $path);

            $data[] = [
                'dir' => $divide[1],
                'mainDir' => base_path($divide[1]),
                'updateDir' => $path
            ];
        }
        return $data;
    }

    private function firstScan($dir): void
    {
        $directory = scandir($dir);
        $existsdir = array_diff($directory, $this->ignoreFiles);
        foreach($existsdir as $dirOrFile){
            $path = $dir .'/'. $dirOrFile;
            if (is_dir($path)) {
                $this->secondScan($path);
            } else {
                if($dirOrFile != 'AppServiceProvider.php' && $dirOrFile != 'RouteServiceProvider.php'){
                    $this->filePath[] = $path;
                }
            }
        }
    }

    private function secondScan($dir): void
    {
        $directory = scandir($dir);
        $existsdir = array_diff($directory, $this->ignoreFiles);
        foreach($existsdir as $dirOrFile){
            $path = $dir .'/'. $dirOrFile;
            if (is_dir($path)) {
                $this->firstScan($path);
            } else {
                if($dirOrFile != 'AppServiceProvider.php' && $dirOrFile != 'RouteServiceProvider.php'){
                    $this->filePath[] = $path;
                }
            }
        }
    }
}
