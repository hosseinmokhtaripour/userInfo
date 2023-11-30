<?php
  function getUserIp(){
    foreach(array('HTTP_CLIENT_IP',
                  'HTTP_X_FORWARDED_FOR',
                  'HTTP_X_FORWARDED',
                  'HTTP_X_CLUSTER_CLIENT_IP',
                  'HTTP_FORWARDER',
                  'REMOTE_ADDR') as $key){
        if(array_key_exists($key , $_SERVER) === true){
          foreach(explode(',', $_SERVER[$key]) as $Ipaddress){
            if(filter_var($Ipaddress,
              filter: FILTER_VALIDATE_IP,
              options: FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
              !== false){
                return $Ipaddress;
              }
          }
        }
      }
  }

  $ip = getUserIp();
  $loc = file_get_contents(filename:"http://ip-api.com/json/$ip");
  echo $loc;
 ?>
