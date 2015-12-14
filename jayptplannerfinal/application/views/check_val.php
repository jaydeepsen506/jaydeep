<div id="page-wrapper">
            <div class="container-fluid">
<?php
$refresh_token = 'bX9z!IAAAAI6Rw0Ipvicx93X7L7srbpUbI1DSAxOwYSJxRfjOVrsJQQEAAAE3Cu6IxUlgnZxPvefnFvc46K8WnBrf8kZEx4LDNfTsiXYjxrrp8ot5pj0rsPzXXLhBL7UGXYOw5MG6EHLZrnoND6Cz7n0j1XxAbBQzeMqj3TA-KeBAdCbJnt-iPXsmmcV9MHlOemQ-yktEfDu_5RBzW6_bkavvz-LTveUo5F01tHlgvaQ090NVJJu8Q8ZaMCpDRd9kX_Q91TpHJqbhNX5QJ8sgHN1PjeytRXwPxA2G5nPCtXHq5QygEIXeYHD02F-1THn4D82zPvouiOIrpVWkI0aUrok3SbGxKNvbp5QcCad0UavLfGKxXDZvg0A59yUK0U8NQdoPh5OocQx0qHIj1y5lDUn0g4cZ4K83MrCgjGQtczQpgPfWW3NrOThKykkXf35saBU8jXHhwpAGZyJRpl175SQWiFxZFIGV5H8r6w';
echo "<br><br>";
    $curl = curl_init( 'https://auth.exorlive.com/Providers/OAuth/Token.ashx' );
    curl_setopt( $curl, CURLOPT_POST, true );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
        'client_id' => 'ptplanner',
        'redirect_uri' => 'http://esolz.co.in/lab6/ptplanner/check_code/check_page',
        'client_secret' => 'QFB57cw2uUTNqJRpr4jKhkQRZZAARneN',
        'grant_type' => 'refresh_token',
        'refresh_token' => $refresh_token
    ) );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
    $auth = curl_exec( $curl );
    $secret = json_decode($auth);
    $access_key = $secret->access_token;
    print_r($secret);
    echo "<br><br>";

    print_r("<h1>Exercises Detail</h1>");
$data = array(
    'query' => array(
        'ReturnResult' => true,
        'ReturnFilter' => true,
         'Query' => '',
         'Type' => 1,
         'Equipment' => 0,
         'Focus' => 0,
         'SortBy' => 5,
         'StartPosition' => 0,
         'Level' => 0,
         'AgeGroup' => 0,
         
    )
);
//
$data_string = json_encode($data); 
$curl = curl_init();
curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Workouts.svc/QueryExercises?culture=en-US',
        CURLOPT_USERAGENT => 'PHP Post Request',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER => array( 
                                'Authorization: Bearer ' . $access_key,
                                'Content-Type: application/json',                                                                                
                                'Content-Length: ' . strlen($data_string)
                                )
                        ));
$auth = curl_exec( $curl );
curl_close($curl);
//
//$all_val = json_decode($auth);
//echo "<pre>";
//print_r($all_val);
//echo "</pre>";

//$curl = curl_init();
//curl_setopt_array($curl, array(
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Workouts.svc/GetListOfAvailableTags',
//        CURLOPT_USERAGENT => 'PHP Post Request',
//        CURLOPT_POST => true,
//        CURLOPT_POSTFIELDS => '',
//        CURLOPT_SSL_VERIFYHOST => false,
//        CURLOPT_SSL_VERIFYPEER => false,
//        CURLOPT_HTTPHEADER => array( 
//                                'Authorization: Bearer ' . $access_key,
//                                'Content-Type: application/json'
//                                )
//                        ));
//$auth = curl_exec( $curl );
//curl_close($curl);

$all_val = json_decode($auth);
echo "<pre>";
print_r($all_val);
echo "</pre>";
//print_r($all_val->d->Data->Exercises);
$list_val = $all_val->d->Data->Exercises;
foreach($list_val as $list)
{
     echo $title = $list->Title;
     echo "<br/>";
}

?>
            </div>
</div>