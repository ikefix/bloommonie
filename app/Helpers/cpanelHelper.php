<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class cPanelHelper
{
    public static function createSubdomain($subdomain, $rootDomain = 'yourdomain.com', $directory = 'public_html/tenants')
    {
        $cpanelUser = 'blootjmm';
        $apiToken = 'Y9HKU10EBU5KT51EDRDBQIVRMLX63UM0';

        $client = new Client([
            'base_uri' => 'https://bloommonie.com/', // ⚠️ Replace with your cPanel host
            'verify' => false,
        ]);

        try {
            $response = $client->get('json-api/cpanel', [
                'headers' => [
                    'Authorization' => "cpanel {$cpanelUser}:{$apiToken}"
                ],
                'query' => [
                    'cpanel_jsonapi_user' => $cpanelUser,
                    'cpanel_jsonapi_apiversion' => '2',
                    'cpanel_jsonapi_module' => 'SubDomain',
                    'cpanel_jsonapi_func' => 'addsubdomain',
                    'domain' => $subdomain,
                    'rootdomain' => $rootDomain,
                    'dir' => "{$directory}/{$subdomain}",
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
