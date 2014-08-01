<?php
// Generic Curl REST function.
// Connection are created demand and closed by PHP on exit.
function curl_rest($method,$uri,$query=NULL,$json=NULL,$options=NULL){
  global $curl_url,$curl_handle,$curl_option_defaults;

  // Connect 
  if(!isset($curl_handle)) $curl_handle = curl_init();

#  echo "DB operation: $method $uri $query $json\n";

   $fd = fopen( "php://memory" , "w+" );
   fwrite( $fd, $json, strlen( $json ));
   fseek( $fd , 0 );
  // Compose query
  $options = array(
    CURLOPT_URL => $curl_url.$uri."?".$query,
    CURLOPT_CUSTOMREQUEST => $method, // GET POST PUT PATCH DELETE HEAD OPTIONS 
    CURLOPT_POSTFIELDS => array( "data" => $json ),
    CURLOPT_POST => TRUE,
    CURLOPT_HTTPHEADER => array (
       'Content-Type: application/json',
       'Content-Length: ' . strlen( $json ) ),
    CURLOPT_INFILE => $fd,
    CURLOPT_INFILESIZE => strlen( $json ),
    CURLOPT_RETURNTRANSFER => true,
  ); 
  curl_setopt_array($curl_handle,($options )); 

  // send request and wait for response
  $response =  curl_exec($curl_handle);
  fclose( $fd );
  echo "Response from DB: ". gettype( $response ). "\n";
  if( gettype( $response ) == "string" ){
      print( $response );
  }
  if( gettype( $response ) == "boolean" ){
      echo curl_error( $curl_handle );
  }
  print_r($response);
  if( gettype( $response ) == 'string' ){
      if( strpos( $response, 'Deadlock' ) != FALSE ){
      	  return false;
      }
  }  
  return($response);
}

 $json_obj = (object)array();
 for( $i = 2 ; $i < count( $argv) ; $i = $i + 2 )
 {
    $json_obj->{$argv[$i]} = $argv[$i+1];
 }
 print_r( $json_obj );
 $str  = json_encode( $json_obj );
 print( $str );
 curl_rest( "POST", $argv[1] ,NULL, json_encode($json_obj) );
 
?>

