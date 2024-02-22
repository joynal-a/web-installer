<?php

namespace Abedin\WebInstaller\Lib\Traits;

trait InstallationTrait
{
    public function setupEnv(array $data): void
    {
        $path = base_path('.env');
        $file = file($path); // Open File Line By line
        $diffFileLines = array_diff($file, ["\n"]); // Remove all empty lines

        foreach($diffFileLines as $lineNo => $value){
            if (strpos($value, 'APP_KEY') !== false) {
                $file[$lineNo] = 'APP_KEY=base64:'. base64_encode(random_bytes(32)) . "\n";
            }
        }

        foreach($data as $peremiter => $newValue){
            $exists = false;
            foreach($diffFileLines as $lineNo => $oldValue){
                if (strpos($oldValue, $peremiter) !== false) {
                    $file[$lineNo] = $peremiter .'='. $newValue . "\n";
                    $exists = true;
                }
            }
            if(!$exists){
                $file[] = $peremiter .'='. $newValue . "\n";
            }
        }
        file_put_contents($path, implode('', $file));
    }

    /**
     * check the fuilds is for database.
     * @return bool
     * @var string
     */
    public function isDbCredential($fiulds): bool
    {
        return substr($fiulds, 0, 2) === 'DB' ? true : false;
    }

    /**
     * check data base connection.
     * @return bool
     * @var string $dbHost
     * @var string $dbName
     * @var string $dbuser
     * @var string $dbPass
     */
    function checkDatabaseConnection(array $data): bool
    {
        try {
            if (@mysqli_connect($data['DB_HOST'], $data['DB_USERNAME'], $data['DB_PASSWORD'], $data['DB_DATABASE'])) {
                return true;
            } else {
                return false;
            }
        }catch(\Exception $exception){
            return false;
        }
    }

}
