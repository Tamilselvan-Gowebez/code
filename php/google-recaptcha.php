<!-- google rechapcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Start : Google Captcha
======================================================================== -->
<div class="mt-2 position-relative">
    <div class="google-recaptcha">
        <div name="g-recaptcha-response" class="g-recaptcha" data-sitekey="6LcK_dUUAAAAABABPYhPx6thvJoYsZtHs7clpL3q" data-callback="verifyCaptcha" data-size="normal"></div>
    </div>
</div>
<!-- End : Google Captcha
======================================================================== -->

<?php

$g_response = '';
// Google Recaptcha Validation
// =================================
foreach ($_POST['formData'] as $key => $value) {
    if ($value['name'] == 'g-recaptcha-response') {
        $g_response = $value['value'];
    }
}

$fields_string = '';
$fields = array(
    'secret' => '6LcK_dUUAAAAAGloJ8TPoKlTHKou1rxVWf1VYX4L',
    'response' => $g_response
);

foreach ($fields as $key => $value) {
    $fields_string .= $key . '=' . $value . '&';
}
$fields_string = rtrim($fields_string, '&');
$curl_inti = curl_init();
curl_setopt($curl_inti, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($curl_inti, CURLOPT_POST, count($fields));
curl_setopt($curl_inti, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($curl_inti, CURLOPT_RETURNTRANSFER, True);
$result_exe = curl_exec($curl_inti);
$result = json_decode($result_exe);
$error = curl_error($curl_inti);
$CurlInfo = curl_getinfo($curl_inti);
curl_close($curl_inti);

if ($result->success != '1') {
    error_log($_SERVER['PHP_SELF'] . " Line :" . __LINE__ . " Captacha Failed");
    error_log(print_r($CurlInfo, true));
    error_log(print_r($result, true));

    exit(json_encode([
        'status'    => 'Failed',
        'code'      => '400',
        'message'   => 'Captcha Validation Failed'
    ]));
}

?>