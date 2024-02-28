<?php

namespace Abedin\WebInstaller\Commands;

use Illuminate\Console\Command;

class MakeJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:json {dir?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for converting php file to JSON';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = $this->argument('dir') ?? $this->ask('Enter the File directory');
        $dir = base_path($dir);
        if(file_exists($dir)){
            $fileInArray = file($dir);
            $data = [];
            foreach($fileInArray as $k => $line){
                $data['line_' . $k] = $line;
            }

            $converJson = json_encode($data, JSON_PRETTY_PRINT);

            $dir = str_replace('.php', '.json', $dir);
            file_put_contents($dir, $converJson);
            $this->info('Convert Success');
            exit;
        }

        $this->warn('You enter a wrong file path');
    }

}
