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
      $dist = 'None';

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

      //make connection
      mysql_connect('localhost', 'root', '');
      //select db
      mysql_select_db('slimapp');
      $sql = "SELECT * FROM pharmacy";
      $records = mysql_query($sql);
    ?>

    <html>

<body>
	<table width="600" border="1">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Adress</th>
		</tr>

		<tr>
			<?php

			while($pharmacy=mysql_fetch_assoc($records))
			{
				echo "<tr>";
		
				echo "<td>".$pharmacy['id']."</td>";
				echo "<td>".$pharmacy['Name']."</td>";
				echo "<td>".$pharmacy['Address']."</td>";
				echo "</tr>";

				$latitude2 = $pharmacy['Latitude'];
				$longitude2 = $pharmacy['Longitude'];

				$distance = getDistance($latitude, $longitude, $latitude2, $longitude2);

				if($dist == 'None')
					$dist = $distance;

				if ($distance < $dist)
				{
					$dist = $distance;
					$marker = $pharmacy['id'];
				}


			}

			print "Shortest Distance: ";
			print_r($dist);
			print "<br><br>";

			$sql2 = "SELECT Name,Address FROM pharmacy where id = $marker";
			$result = mysql_query($sql2);

			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
			{
    			print_r($row);
			}

			function getDistance($lat1, $long1, $lat2, $long2)
			{
				$earthRadius = 6371;
				$latFrom = deg2rad($lat1);
				$lonFrom = deg2rad($long1);
				$latTo = deg2rad($lat2);
				$lonTo = deg2rad($long2);

				$latDelta = $latTo -$latFrom;
				$lonDelta = $lonTo - $lonFrom;

				$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) * cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

				return $angle * $earthRadius;
			}
			?>
		</tr>
	</table>
</body>

</html>
