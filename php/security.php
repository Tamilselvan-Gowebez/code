<?php

//  Validate Unauthorized Request
// =================================
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(400);
    exit(json_encode([
        "status"    => 'rejected',
        "code"      => '400.1',
        "message"   => "Unauthorized Request."
    ]));
}

//  Exit if POST Method not used
// =================================
if (empty($_SERVER['REQUEST_METHOD']) || ($_SERVER['REQUEST_METHOD'] != 'POST')) {
    http_response_code(400);
    exit(json_encode([
        "status"    => 'Error',
        "code"      => '400.2',
        "message"   => "Bad Request."
    ]));
}

// Sanitize Inputs Function
// =================================
function sanitize($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}