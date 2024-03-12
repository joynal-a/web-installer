write this code on apsservice provider in boot method
try{
    $_SERVER['argv'];
}catch(Exception $e){
    if (!file_exists(base_path('storage/installed')) && !request()->is('install') && !request()->is('install/*')) {
        header("Location: install");
        exit;
    }
}

step 1
php artisan make:verify-code https://example.com/api/verify-code 
if you use web install with verify purchase you need this step

step 2
 $client = new Client();
 $response = $client->get('https://api.envato.com/v3/market/author/sale', [
                'headers' => [
                    'Authorization' => 'Bearer api key',
                    'Accept' => 'application/json'
                ],
                'query' => [
                    'code' => "purchase code"
                ],
            ]);
$response = json_decode($response->getBody(), true);

step 3
if you send some file when veriy purchase 
php artisan make:json your file directory

and store the json file in your support server and if purchase is verified send it same response 

'permission' => true,
'restore' => [
    [
        'dir' => 'where you store this json file like routes/web.php',
        'source_code' =>  file_get_contents(your json file path);
    ],
]