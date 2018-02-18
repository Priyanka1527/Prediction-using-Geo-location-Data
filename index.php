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

      //declare the variables needed for calculating shortest distance
      $dist = 'None';
      $marker = 0;

      // close Curl resource, and free up system resources
      curl_close ($ch);

      // Decodethe JSON data and keet it in the variable
      $ret_array = json_decode($data);

      //Print the JSON packet returned containing geo-location information of the user
      print "<pre>";
      $location = $ret_array->loc;
      print_r($ret_array);
      print "</pre>"; 

      //Split the location information based on comma to separate the current Latitude and Longitude of the user
      $loc_divide = explode(",", $location);
      $latitude = $loc_divide[0];
      $longitude = $loc_divide[1];

      //Print the current Latitude & Longitude of the user
      print "Latitude: ";
      print_r($latitude);
      print "<br>";
      print "Longitude: ";
      print_r($longitude);

      //make connection
      mysql_connect('localhost', 'root', '');
      //select db
      mysql_select_db('slimapp');
      //retrieve all the Rows from the table
      $sql = "SELECT * FROM pharmacy";
      //execute the query above and in case of success, put the resource in the variable 'records'
      $records = mysql_query($sql);
    ?>

    /
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
			//looping through all the records
			while($pharmacy=mysql_fetch_assoc($records))
			{
				echo "<tr>";
				echo "<td>".$pharmacy['id']."</td>";
				echo "<td>".$pharmacy['Name']."</td>";
				echo "<td>".$pharmacy['Address']."</td>";
				echo "</tr>";

				//retrieve the latitude & longitude of the current row being travesered
				$latitude2 = $pharmacy['Latitude'];
				$longitude2 = $pharmacy['Longitude'];

				//call the function to calculate the distance in miles between current pharmacy's latitude/longtidue and user's latitude/longitude
				$distance = getDistance($latitude, $longitude, $latitude2, $longitude2);

				//calculate the shortest distance in miles
				if($dist == 'None')
				{
					$dist = $distance;
					$marker = $pharmacy['id'];
				}
				else

				if ($distance < $dist)
				{
					$dist = $distance;
					$marker = $pharmacy['id'];
				}
			}
			//print the shortes distance calculated
			print "<br><br>";
			print "Shortest Distance: ";
			print_r($dist);
			print "<br><br>";

			//Retrive the packet containing nearest Pharmacy's Name and Address
			$sql2 = "SELECT Name,Address FROM pharmacy where id = $marker";
			$result = mysql_query($sql2);

			while ($row = mysql_fetch_array($result)) 
			{
    			print_r($row);
			}

			//method to calculate the shortest distance in miles
			function getDistance($lat1, $long1, $lat2, $long2)
			{
				$theta = $long1 - $long2;
				$dis = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dis = acos($dis);
				$dis = rad2deg($dis);
				$miles = $dis * 60 * 1.515;
				return $miles;
			}
			?>
		</tr>
	</table>
</body>
</html>
