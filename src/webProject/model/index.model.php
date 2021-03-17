<?php

/**
 * @param $api_method la méthode à utiliser
 * @param $api_url l'url à appeler
 * @param false $data les informations à passer en paramètre
 * @return mixed le résultat
 */
function CallAPI($api_method, $api_url, $data = false) {

    $curl = curl_init($api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    switch ($api_method)
    {
        case "GET":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
    }
    $curl_response = curl_exec($curl);
    $data = json_decode($curl_response);

    /*
    * Check for 404 (file not found).
    */
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // Check the HTTP Status code
    switch ($httpCode) {
        case 200:
            $api_error_status = "200: Success";
            return ($data);
            break;
        case 404:
            $api_error_status = "404: API Not found";
            break;
        case 500:
            $api_error_status = "500: servers replied with an error.";
            break;
        case 502:
            $api_error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
            break;
        case 503:
            $api_error_status = "503: service unavailable. Hopefully they'll be OK soon!";
            break;
        default:
            $api_error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
            break;
    }
    curl_close($curl);
    echo $api_error_status;
    die;
}