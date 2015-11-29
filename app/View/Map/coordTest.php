<!-- 
	Created by Evan Melquist.
 -->
<!-- 
 	Modified by: Richard Levenson and Hunter Dubel to include function to call PointAnalysis.exe file for point prediction.
 -->
 

<?php
	// Runs the PointAnalysis executable file to find the cluster info of the point
	// Takes the latitude and longitude strings as input parameters and returns the cluster information.
	function runPointAnalysis($lat, $long){
		exec("SOAP/app/View/Results/src/PointAnalysis $lat $long" , $clusterInfo);
		return $clusterInfo;
	}
?>
