<?php


      // create a new Curl resource
      $ch = curl_init ();

      // set URL and other appropriate options
      curl_setopt ($ch, CURLOPT_URL, "http://ipecho.net/plain");
      curl_setopt ($ch, CURLOPT_HEADER, 0);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

      // grab URL and pass it to the browser

      $ip = curl_exec ($ch);
      echo "The public ip for this server is: $ip";

      $url = 'http://ipinfo.io/'.$ip;
      $ch = curl_init($url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);

      // close cURL resource, and free up system resources
      curl_close ($ch);

      $ret_array = json_decode($data);

      print "<pre>";
      $location = $ret_array->loc;
      print_r($ret_array);
      print "</pre>"; 

      $loc_divide = explode(",", $location);
      $latitude = $loc_divide[0];
      $longitude = $loc_divide[1];

      print "Latitude: ";
      print_r($latitude);
      print "<br>";
      print "Longitude: ";
      print_r($longitude);
      
    ?>
