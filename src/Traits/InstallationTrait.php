<?php

namespace Abedin\WebInstaller\Traits;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\BufferedOutput;
use InvalidArgumentException;
use RuntimeException;

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
                if (strpos($oldValue, $peremiter . '=') !== false) {
                    $file[$lineNo] = $peremiter .'="'. $newValue . '"' . "\n";
                    $exists = true;
                }
            }
            // if(!$exists){
            //     $file[] = $peremiter .'="'. $newValue . '"' . "\n";
            // }
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
    public function checkDatabaseConnection(array $data): bool
    {
        try {
            if (@mysqli_connect($data['DB_HOST'], $data['DB_USERNAME'], $data['DB_PASSWORD'], $data['DB_DATABASE'])) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $exception){
            return false;
        }
    }

    /**
     * Check .env and possible to migration
     * @return void
     */
    public function getReadyToRun(): void
    {
        $outputLog = new BufferedOutput;
        Artisan::call('migrate:fresh', ['--force' => true], $outputLog);
        Artisan::call('storage:link', ['--force' => true]);
        if(config('installer.seeder_run')){
            Artisan::call('db:seed', ['--force' => true], $outputLog);
        }
    }

    protected function createInstalationFile(): void
    {
        $signature =  base64_encode('Congratulations, The Installation Process is Completed successfully. The Installation process is made by Joynal Abedin. Thanks for with us');
        $path = storage_path('installed');
        file_put_contents($path, $signature);
    }

    private function decrypt($encryptedCode, $key): string|bool
    {
        $data = base64_decode($encryptedCode);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
    }

    public function verifyCode(array $data, $url)
    {
        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Output the API response
        return $response;
    }

    /**
     * @return void
     * Note: This method is only for additonal commands.
     */
    public function runInstallCommands(): void
    {
        $commands = config('installer.install_commands');
        $changeToBasePath = 'cd ' . base_path();
        foreach($commands as $command){
            shell_exec($changeToBasePath . ' && ' . $command);
        }
    }

    /**
     * @return void
     */
    public function makeJsonToPhpFile($path, $sourceCode): void
    {
        $relativePath = $this->validateRestorePath($path);
        $extension = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));
        $content = $this->buildValidatedRestoreContent($sourceCode, $extension);
        $fullPath = base_path($relativePath);

        File::ensureDirectoryExists(dirname($fullPath));
        File::put($fullPath, $content);
    }

    /**
     * Only allow restore writes to explicitly approved application paths.
     * This prevents license verification responses from writing to arbitrary files.
     */
    protected function validateRestorePath(string $path): string
    {
        $normalizedPath = trim($path);

        if ($normalizedPath === '') {
            throw new InvalidArgumentException('Restore path cannot be empty.');
        }

        if (str_contains($normalizedPath, "\0") || str_contains($normalizedPath, '\\')) {
            throw new InvalidArgumentException('Restore path contains invalid characters.');
        }

        if (str_starts_with($normalizedPath, '/') || preg_match('/^[A-Za-z]:\//', $normalizedPath)) {
            throw new InvalidArgumentException('Absolute restore paths are not allowed.');
        }

        if (
            str_contains($normalizedPath, '../') ||
            str_contains($normalizedPath, './') ||
            str_contains($normalizedPath, '/..') ||
            $normalizedPath === '..' ||
            $normalizedPath === '.'
        ) {
            throw new InvalidArgumentException('Directory traversal is not allowed in restore paths.');
        }

        if (!preg_match('/^[A-Za-z0-9_\/\.-]+$/', $normalizedPath)) {
            throw new InvalidArgumentException('Restore path contains unsafe characters.');
        }

        $fileName = basename($normalizedPath);
        if (!preg_match('/^[A-Za-z0-9_.-]+$/', $fileName) || str_starts_with($fileName, '.')) {
            throw new InvalidArgumentException('Restore file name is not allowed.');
        }

        $allowedExtensions = config('installer.restore.allowed_extensions', ['php']);
        $extension = strtolower(pathinfo($normalizedPath, PATHINFO_EXTENSION));
        if ($extension === '' || !in_array($extension, $allowedExtensions, true)) {
            throw new InvalidArgumentException('Restore file type is not allowed.');
        }

        $allowedDirectories = config('installer.restore.allowed_directories', []);
        foreach ($allowedDirectories as $directory) {
            $directory = trim($directory, '/');
            if ($directory !== '' && ($normalizedPath === $directory || str_starts_with($normalizedPath, $directory . '/'))) {
                return $normalizedPath;
            }
        }

        throw new InvalidArgumentException('Restore path is outside the approved directories.');
    }

    /**
     * The restore payload must be a JSON encoded array of source lines.
     * We rebuild the file content from validated strings instead of writing raw input directly.
     */
    protected function buildValidatedRestoreContent(string $sourceCode, string $extension): string
    {
        if (str_contains($sourceCode, "\0")) {
            throw new InvalidArgumentException('Restore content contains invalid binary data.');
        }

        $decoded = json_decode($sourceCode, true);
        if (!is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Restore content must be a valid JSON array.');
        }

        $content = '';
        foreach ($decoded as $line) {
            if (!is_string($line) || str_contains($line, "\0")) {
                throw new InvalidArgumentException('Restore content contains invalid lines.');
            }

            $content .= $line;
        }

        if ($content === '') {
            throw new InvalidArgumentException('Restore content cannot be empty.');
        }

        if ($extension === 'php') {
            if (!str_starts_with(ltrim($content), '<?php')) {
                throw new RuntimeException('Restore PHP files must start with an opening PHP tag.');
            }

            if (@token_get_all($content) === false) {
                throw new RuntimeException('Restore PHP content could not be parsed safely.');
            }
        }

        if ($extension === 'json') {
            json_decode($content, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Restore JSON content is invalid.');
            }
        }

        return $content;
    }
}
