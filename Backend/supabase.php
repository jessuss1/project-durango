<?php
require_once 'config.php';

function supabaseApiRequest($method, $endpoint, $data = null, $useServiceKey = false) {
    global $supabaseUrl, $anonKey, $serviceKey;

    $url = "$supabaseUrl/rest/v1/$endpoint";
    $key = $useServiceKey ? $serviceKey : $anonKey;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Define and set headers
    $headers = [
        "apikey: $key",
        "Authorization: Bearer $key",
        "Content-Type: application/json",
    ];
    if (strtoupper($method) === 'POST' || strtoupper($method) === 'PATCH') {
        $headers[] = "Prefer: return=representation";
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    switch (strtoupper($method)) {
        case 'GET':
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case 'PATCH':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default:
            die("Unsupported method: $method");
    }

    $response = curl_exec($ch);
    if ($response === false) {
        die("cURL Error: " . curl_error($ch));
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);
    if ($httpCode >= 400) {
        die("API Error ($httpCode): " . ($result['message'] ?? 'Unknown error'));
    }

    return $result;
}