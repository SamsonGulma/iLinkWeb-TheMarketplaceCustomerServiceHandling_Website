<?php

require __DIR__ . '/vendor/autoload.php'; // Adjust the path to autoload.php as per your project setup

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function generateRandomString($length = 10)
{
    return bin2hex(random_bytes($length));
}

$refNo = "kaleb" . generateRandomString(5); // Adjust the length as per your requirement
$secretKey = 'CHAPUBK_TEST-ArCtaMSW6ycA0ddgSE3lWDgNFCjJKXuJ'; // Get secret key from environment variable

$client = new Client([
    'base_uri' => 'https://api.chapa.co/v1/',
    'headers' => [
        'Authorization' => 'Bearer ' . $secretKey,
        'Content-Type' => 'application/json',
    ],
]);

try {
    $response = $client->post('transaction/initialize', [
        'json' => [
            "amount" => '1000',
            "currency" => "ETB",
            "first_name" => "Kaleb",
            "last_name" => "Alebachew", 
            "phone_number" => "0923349106",
            "tx_ref" => $refNo,
            "return_url" => "http://localhost:8000",
            "customization" => [
                "title" => "Chapa-starter",
                "description" => "something", 
            ]
        ]
    ]);

    $statusCode = $response->getStatusCode();
    if ($statusCode == 200) {
        $responseData = json_decode($response->getBody(), true);
        $checkoutUrl = $responseData['data']['checkout_url'];
        // Redirect to checkout URL
        header("Location: $checkoutUrl");
        exit;
    } else {
        throw new Exception('Failed to initialize transaction: ' . $response->getBody());
    }
} catch (RequestException $e) {
    // Guzzle RequestException handles errors like network issues, 4xx, 5xx responses
    $errorMessage = 'Guzzle request failed: ' . $e->getMessage();
    echo $errorMessage;
    // Optionally log the error
    error_log($errorMessage);
    http_response_code(500); // Set HTTP response code to 500
} catch (Exception $e) {
    // Handle other exceptions
    $errorMessage = 'Failed to initialize transaction: ' . $e->getMessage();
    echo $errorMessage;
    // Optionally log the error
    error_log($errorMessage);
    http_response_code(500); // Set HTTP response code to 500
}
