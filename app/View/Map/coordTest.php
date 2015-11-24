<!-- 
	Created by Evan Melquist.
 -->
<!-- 
 	Modified by: Richard Levenson and Hunter Dubel to include function to call PointAnalysis.exe file for point prediction.
 -->
 

<?php
	// Runs the PointAnalysis executable file to find the cluster info of the point
	// Takes the latitude and longitude strings as input parameters.
	function runPointAnalysis($lat, $long){
		//$lat = strip_tags($_GET[latitudeSearchBar]);
		//$lon = strip_tags($_GET[longitudeSearchBar];
		
		//echo ("Latitude:" .$lat. "<BR>Longitude:" .$lon.);
		//exec("SOAP/app/View/Results/src/PointAnalysis " . $lat . " " . $long , $clusterInfo);
		exec("SOAP/app/View/Results/src/PointAnalysis $lat $long" , $clusterInfo);
		return $clusterInfo;
	}
?>