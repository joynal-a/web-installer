<?php

namespace Abedin\WebInstaller\Commands;

use Illuminate\Console\Command;

class VerifyCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:verify-code {url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate encripted verify code';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $url = $this->argument('url') ?? $this->ask('Enter the URL that you encrypt');

        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedData = openssl_encrypt($url, 'aes-256-cbc', 'Joynala', 0, $iv);
        $this->info('*******************YOUR ENCRIPTION CODE*******************');
        echo(base64_encode($iv . $encryptedData));
        $this->info("\n*******************<<<<<<<<<<>>>>>>>>>>*******************");
    }
}
