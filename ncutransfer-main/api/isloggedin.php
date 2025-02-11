<?php
/* Reference: ChatGPT */
//Autoload Composer
require __DIR__.'/vendor/autoload.php';

//Use JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$token = "";
// Get the token from the Authorization header. If there isn't any, generate one
if (isset($_SERVER['HTTP_AUTHORIZATION']))
{
    $token = $_SERVER['HTTP_AUTHORIZATION'];
}
elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
{
    $token = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
}

// Extract the token from the Authorization header, if present
if ($token !== null)
{
    // Check if the Authorization header starts with 'Bearer'
    if (strpos($token, 'Bearer ') === 0) {
        // Extract the token part (excluding 'Bearer ')
        $token = substr($token, 7);
        // Trim any leading or trailing whitespace
        $token = trim($token);
    }
}
if ($token == 'null') /* Self-defined function generateJWTToken() */
{
    require_once('jwt_init.php');
    generateJWTToken(false, "No Login");
    $token = $_SESSION['jwt'];
}

// Validate and decode the token
try
{
    require_once('jwt_init.php');
    $key = JWT_KEY;
    $decoded = JWT::decode($token, new Key($key, 'HS256'));
    // Token is valid, you can access the payload data
    $responseData = [
        'isLoggedIn' => $decoded->isLoggedIn,
        'id' => $decoded->id,
    ];
    /* $responseData = array(
        'isLoggedIn' => true,
        'id' => '111403508'
    ); */
    
    // Convert the payload data to JSON
    $jsonResponse = json_encode($responseData);
    
    // Set appropriate headers to indicate JSON content
    header('Content-Type: application/json');
    
    // Send the JSON response to the client
    echo $jsonResponse;
}
catch (Exception $e)
{
    // Token is invalid or expired
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized"]);
}
?>

