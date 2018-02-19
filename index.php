<html>
 <body>
 	<table id="t02" align="center">
 		<tr>
 			<td>
	<?php
      // create a new Curl resource
      $ch = curl_init ();

      // set URL and other appropriate options
      curl_setopt ($ch, CURLOPT_URL, "http://ipecho.net/plain");
      curl_setopt ($ch, CURLOPT_HEADER, 0);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

      // grab URL and pass it to the browser

      $ip = curl_exec ($ch);
      print "The public ip for this server is: $ip";
      print "<br><br><br><br>The Latitude/Longitude representing the current location of the user are: <br>";

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
      //print "<pre>";
      $location = $ret_array->loc;
      //print_r($ret_array);
      //print "</pre>"; 

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

   
   
	<table id="t01">
		<tr>
			<th>Name</th>
			<th>Address</th>
		</tr>
		<tr>
			<?php
			//looping through all the records
			while($pharmacy=mysql_fetch_assoc($records))
			{
				/*echo "<tr>";
				echo "<td>".$pharmacy['id']."</td>";
				echo "<td>".$pharmacy['Name']."</td>";
				echo "<td>".$pharmacy['Address']."</td>";
				echo "</tr>";*/

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
			print "<br><br><br>";
			print "Nearest Pharmacy having distance: ";

			//round up the calculated value upto 2 decimal places
			$formatted_distance = round($dist,2);
			print_r($formatted_distance);
			print " miles<br><br>";

			//Retrieve the packet containing nearest Pharmacy's details
			$sql2 = "SELECT * FROM pharmacy where id = $marker";
			$result = mysql_query($sql2);

			while ($row = mysql_fetch_array($result)) 
			{
				echo "<tr>";
				//print the Name of the nearest Pharmacy
				echo "<td>".$row['Name']."</td>";
				//print the Address of the nearest Pharmacy with City,State and Zip
				echo "<td>".$row['Address']. ", ". $row['City']. ", ".$row['State']." - ".$row['Zip']."</td>";
				echo "</tr>";
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
</td>
</tr>
</table>
</body>
</html>

<style>

   	table#t01 
   	{
    width: 100%; 
    background-color: #f1f1c1;
    border: 1px solid black;
    text-align: center;
	}

	table#t02
   	{
   	align: center;
    width: 50%; 
    background: linear-gradient(to bottom, #33ccff 0%, #ffffff 100%);
    border: 1px solid black;
	}

	table, th, td 
	{
    border: 1px solid black;
    border-collapse: collapse;
	}

	body
	{
		background-image:url(background.jpg);
		background-size:100% 100vh;
		background-repeat:no-repeat;

	}
 </style>
