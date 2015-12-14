<div id="page-wrapper">
            <div class="container-fluid">
<?php
if(isset($_REQUEST['code']))
{
////echo $_REQUEST['code'];
//$curl = curl_init( 'https://auth.exorlive.com/Providers/OAuth/Token.ashx' );
//curl_setopt( $curl, CURLOPT_POST, true );
//curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
//    'client_id' => 'ptplanner',
//    'redirect_uri' => 'http://esolz.co.in/lab6/ptplanner/check_code/check_page',
//    'client_secret' => 'QFB57cw2uUTNqJRpr4jKhkQRZZAARneN',
//    'code' => $_GET['code'], // The code from the previous request
//    'grant_type' => 'authorization_code'
//) );
//curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
//$auth = curl_exec( $curl );
//$secret = json_decode($auth);
// $access_key = $secret->access_token;
//$refresh_token = $secret->refresh_token;
//print_r($secret);
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


//$data = array(
//    'Location' => "1",
//    'LocationId' => '0',
//    'Query' => "",
//    'Nested' => "1",
//    'Start' => "0",
//    'Length' => "1",
//    'OnlyTemplates' => "0"
//);
//$data_string = json_encode($data);       
////$access_key = '6c4X!IAAAAMaZp8mRLUlS95zDI5oWdZTL_dqRDHHNRpDzf0NJS7SM8QAAAAF7gp0NL3tG7uQ-dlvApBKmpeXfFOzg8BMdd7GvDy3_XqDDnQZr-t1L5fMr-bcKX5HBli-c7xVl9bYia-he9wJFZVp2RNR6dUoQZ_NnrIJhe4ybfKfakDjXFIcVtTSDZxP9cUpJEz0sfVQuZvGJKXKyxckrn0TL69-AqaRBa5jgKb6fws-QUE5L9H5T76rrx4MuMelNVSie4Ypkpt5qszF4ckKbRubIBmNAAaQLQqwvO3nOn7PjLRzpIbBXgdJ5qXNtIHQ4h8qQQ4fEq04Nu9C1pqluKV0mmIZO580cy2Ri3tmIYBx4rxAmIet210VNnywAAEAAEcS0-TNp2o_jIc1k_B9jPmjgF0tlp7pO3L4U49ISx0klYQ4ZmE4uGXjjNAXJuPwl7Bd7ITt_DUO_YjCDGdW92ZY3kZmrvSeyXq5q8s49Bj8CgnEiFpaNTmqv5fGZXUo0xWdfzL4jSqrCEW9PHf2-vQnAzp1knMwpBiDgygloY7u-NwNMVAfPY0rH4hNDVDtMWzOMZu6fOKNSM0CrHZv8e7pZL5iGMwUXaTjJWO9TtOsz7WWcriE1iNu2jUveHFijUGv0D_0_vxfjkkR1d4Re6cmh_BIcFGaIvjUqy0lm3V_wH9t3SubKbXn0E757U7JrahsxXTotRJbGtpfZ6ZTuOqkAQAAAAEAAEE07DGCIEN8yeXF8Kam77CRL_yXy9xsJRl_Enx7au_3J2NUmg1HiDYagD17phZ7T_BSu-iNGF_ltIUMbDXNpf8F-L8S0FnJ46A9LiWYp0byUrxis_DaXbCDpA-BO6FNAOm59KI-c5X3QwzTcUFylV9jOKvabzowXwGECENr4dWxG2FnWUID9WvBL_I6-kXl8D21eqbD-uzWcTGl1ZyBWXCJb6NB1iS9pZCpE5pU3Of6f7G-o-Zw4F2aXYJSSTmNg_SAmE50nvwE6SMHRaC4RazzOttVdtPTvPrKwCrulBloFvKkfYQ6g-3JtiwnukvrUKx4kUwuH1K_wy4PyaHfBBMLVFRWm28L5o90LJfc0eQXJeI0_TUTu5j7wPGtycpWIMJ9fvXJ_q5FcHH54PwgqRbx10EdjeeAhrN34IPJga9Vtd7cPe0h8T0k4BbYcvywGQAbvx9BdiQem4LeSimzTbFCOAV8Um7QnCXd3naldORwaDd4VJyADnMbe7cQTtkWISFH9OlqtkgpXMtqFTuw5zgysMZNy2MsMiG6DW107uZh';
//$curl = curl_init( 'https://exorlive.com/WebServices/V1/Workouts.svc/QueryWorkouts' );
//curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer ' . base64_encode($access_key) ) );
//curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
//    'Content-Type: application/json',                                                                                
//    'Content-Length: ' . strlen($data_string))                                                                       
//);                                                 
//curl_setopt( $curl, CURLOPT_POSTFIELDS, $data_string);
//$auth = curl_exec( $curl );
//curl_close($curl);
//$secret = json_decode($auth);
////$access_key = $secret->access_token;
//print_r($secret);


////$access_key = 'YOUR_API_TOKEN';
//$curl = curl_init( 'https://exorlive.com/WebServices/V1/Persons.svc/GetListOfUsers' );
//curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer "6c4X!IAAAAMaZp8mRLUlS95zDI5oWdZTL_dqRDHHNRpDzf0NJS7SM8QAAAAF7gp0NL3tG7uQ-dlvApBKmpeXfFOzg8BMdd7GvDy3_XqDDnQZr-t1L5fMr-bcKX5HBli-c7xVl9bYia-he9wJFZVp2RNR6dUoQZ_NnrIJhe4ybfKfakDjXFIcVtTSDZxP9cUpJEz0sfVQuZvGJKXKyxckrn0TL69-AqaRBa5jgKb6fws-QUE5L9H5T76rrx4MuMelNVSie4Ypkpt5qszF4ckKbRubIBmNAAaQLQqwvO3nOn7PjLRzpIbBXgdJ5qXNtIHQ4h8qQQ4fEq04Nu9C1pqluKV0mmIZO580cy2Ri3tmIYBx4rxAmIet210VNnywAAEAAEcS0-TNp2o_jIc1k_B9jPmjgF0tlp7pO3L4U49ISx0klYQ4ZmE4uGXjjNAXJuPwl7Bd7ITt_DUO_YjCDGdW92ZY3kZmrvSeyXq5q8s49Bj8CgnEiFpaNTmqv5fGZXUo0xWdfzL4jSqrCEW9PHf2-vQnAzp1knMwpBiDgygloY7u-NwNMVAfPY0rH4hNDVDtMWzOMZu6fOKNSM0CrHZv8e7pZL5iGMwUXaTjJWO9TtOsz7WWcriE1iNu2jUveHFijUGv0D_0_vxfjkkR1d4Re6cmh_BIcFGaIvjUqy0lm3V_wH9t3SubKbXn0E757U7JrahsxXTotRJbGtpfZ6ZTuOqkAQAAAAEAAEE07DGCIEN8yeXF8Kam77CRL_yXy9xsJRl_Enx7au_3J2NUmg1HiDYagD17phZ7T_BSu-iNGF_ltIUMbDXNpf8F-L8S0FnJ46A9LiWYp0byUrxis_DaXbCDpA-BO6FNAOm59KI-c5X3QwzTcUFylV9jOKvabzowXwGECENr4dWxG2FnWUID9WvBL_I6-kXl8D21eqbD-uzWcTGl1ZyBWXCJb6NB1iS9pZCpE5pU3Of6f7G-o-Zw4F2aXYJSSTmNg_SAmE50nvwE6SMHRaC4RazzOttVdtPTvPrKwCrulBloFvKkfYQ6g-3JtiwnukvrUKx4kUwuH1K_wy4PyaHfBBMLVFRWm28L5o90LJfc0eQXJeI0_TUTu5j7wPGtycpWIMJ9fvXJ_q5FcHH54PwgqRbx10EdjeeAhrN34IPJga9Vtd7cPe0h8T0k4BbYcvywGQAbvx9BdiQem4LeSimzTbFCOAV8Um7QnCXd3naldORwaDd4VJyADnMbe7cQTtkWISFH9OlqtkgpXMtqFTuw5zgysMZNy2MsMiG6DW107uZh"
//'  ) );
//
//
//curl_setopt_array( $curl, array(
//  CURLOPT_POSTFIELDS => array(
//    'unitId' => '0',
//    'role' => '0',
//    'page' => '0',
//    'pagesize' => '1000', // The code from the previous request
//),  // multipart/form-data
//  CURLOPT_POST => true,                     // application/x-www-form-urlencoded
//) );

//$data = array(
//   'unitId' => '0',
//    'role' => '32',
//    'page' => '0',
//    'pagesize' => '1000', 
//);
//$data_string = json_encode($data); 
//$curl = curl_init( 'https://exorlive.com/WebServices/V1/Persons.svc/GetListOfUsers' );
//curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer ' . base64_encode($access_key) ) );
//curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
//    'Content-Type: application/json',                                                                                
//    'Content-Length: ' . strlen($data_string))                                                                       
//);                                                 
//curl_setopt( $curl, CURLOPT_POSTFIELDS, $data_string);
//$auth = curl_exec( $curl );
//curl_close($curl);
//$secret = json_decode($auth);
////$access_key = $secret->access_token;
//print_r($secret);

$data = array(
	'personId' => 1464931
	);
$data_string = json_encode($data); 
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Persons.svc/GetPersonDetails',
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
if(!$auth){
	print_r('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
print_r("Auth is $auth and curl is $curl. Data string is $data_string.");
curl_close($curl);


print_r("<h1>Second attempt</h1>");
$data = array(
	'personId' => 1464931,
	'customId' => 2000
	);
$data_string = json_encode($data); 
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Persons.svc/SetCustomId',
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
if(!$auth){
	print_r('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
print_r("Auth is $auth and curl is $curl. Data string is $data_string.");
curl_close($curl);

print_r("<h1>Third attempt</h1>");
$data = array(
   'unitId' => '0',
    'role' => '0',
    'page' => '0',
    'pagesize' => '1000', 
);
$data_string = json_encode($data); 
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Persons.svc/GetListOfUsers',
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
if(!$auth){
	print_r('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
$data_val = json_decode($auth);
print_r($data_val);
echo "<br/>";
print_r("curl is $curl. Data string is $data_string.");
curl_close($curl);




print_r("<h1>Exercises Detail</h1>");
//$data = array(
//    'query' => array(
//        'ReturnResult' => true,
//        'ReturnFilter' => true,
//         'Query' => '',
//         'Type' => 1,
//         'Equipment' => 0,
//         'Focus' => 0,
//         'SortBy' => 5,
//         'StartPosition' => 0,
//         'Level' => 0,
//         'AgeGroup' => 0,
//    )
//);
//
////$data = array(
////    'query' => array(
////        'Location' => 1,
////        'LocationId' => 1464950,
////        'Start' => 0,
////        'Length' => 20,
////        'Query' => "",
////        'Nested' => false,
////        'OnlyFavorites' => false,
////        'OnlyTemplates' => false
////    )
////);
//$data_string = json_encode($data); 
//$curl = curl_init();
//curl_setopt_array($curl, array(
//	CURLOPT_RETURNTRANSFER => 1,
//	CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Workouts.svc/QueryExercises',
//	CURLOPT_USERAGENT => 'PHP Post Request',
//	CURLOPT_POST => true,
//	CURLOPT_POSTFIELDS => $data_string,
//	CURLOPT_SSL_VERIFYHOST => false,
//	CURLOPT_SSL_VERIFYPEER => false,
//	CURLOPT_HTTPHEADER => array( 
//				'Authorization: Bearer ' . $access_key,
//				'Content-Type: application/json',                                                                                
//				'Content-Length: ' . strlen($data_string)
//				)
//			));
//$auth = curl_exec( $curl );
//if(!$auth){
//	print_r('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
//}
//print_r("Auth is $auth and curl is $curl. Data string is $data_string.");
//curl_close($curl);


$data = array(
   'id' => 701
);


$data_string = json_encode($data); 
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://exorlive.com/WebServices/V1/Workouts.svc/GetExercise',
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
$data_val = json_decode($auth);
echo "<pre>";
print_r($data_val);
echo "</pre>";




//$data = array(
//   'personId' => 1001
//);
//$data_string = json_encode($data); 
//$curl = curl_init( 'https://exorlive.com/WebServices/V1/Persons.svc/GetPersonDetails' );
//curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer ' . $access_key ) );
//curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
//    'Content-Type: application/json',                                                                                
//    'Content-Length: ' . strlen($data_string))                                                                       
//);                                                 
//curl_setopt( $curl, CURLOPT_POSTFIELDS, $data_string);
//$auth = curl_exec( $curl );
//curl_close($curl);
//$secret = json_decode($auth);
////$access_key = $secret->access_token;
//print_r($secret);
}
?>
 </div>
 </div>