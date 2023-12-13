<?php
//////////////////// config OAuth//////////////////////////////

$OpenIdProviderUrl = "http://testopenid.ega.or.th/"; 
$eServiceUrl = "http://127.0.0.1:8090/OpenID/";
$xmlUrl = "http://testopenid.ega.or.th/XmlUserInfo.aspx";  


$key = 'sampleconsumer';
$secret = 'samplesecret';
$debug = true;
$base_url = $eServiceUrl."OAuthConsumer.php";
$request_token_endpoint = $OpenIdProviderUrl.'OAuth.ashx';
$scope='http://tempuri.org/IDataApi/GetName';
$authorize_endpoint = $OpenIdProviderUrl.'OAuth.ashx';
$oauth_access_token_endpoint = $OpenIdProviderUrl.'OAuth.ashx';

///////////////////////////////////////////////////////////////////

/***************************************************************************
 * Function: Run CURL
 * Description: Executes a CURL request
 * Parameters: url (string) - URL to make request to
 *             method (string) - HTTP transfer method
 *             headers - HTTP transfer headers
 *             postvals - post values
 **************************************************************************/
function run_curl($url, $method = 'GET', $headers = null, $postvals = null){
    $ch = curl_init($url);
    
    if ($method == 'GET'){
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    } else {
        $options = array(
            CURLOPT_HEADER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_VERBOSE => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $postvals,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_TIMEOUT => 3
        );
        curl_setopt_array($ch, $options);
    }
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}
?>

