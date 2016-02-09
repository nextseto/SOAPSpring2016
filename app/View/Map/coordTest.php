<!-- 
	Created By: Evan Melquist, Zachary Nelson, Richard Levenson, Jeremy Leon and Hunter Dubel
	Course: CSC 415
	Semester: Fall 2015
	Instructor: Dr. Pulimood
	Project Name: Pollution Prediction
	Description: Represents the html code for the prediction popup on custom coordinates.
	Filename: prediction.ctp
	Last Modified On: 12/3/15 by Evan Melquist, Jeremy Leon, Zach Nelson, and Richard Levenson

 	INFORMATION FOR FUTURE SOAP TEAMS:
	This file contains a sample of code that could potentially run the PointAnalysis c++ executable file which analyzes the 
	coordinates with the clusters formed by the clustering algorithm.  It has not yet been implemented in SOAP but should
	in the future be called from SOAP/app/webroot/js/map.js file and passed the latitude and longitude.
 -->
 

<?php
	// Runs the PointAnalysis executable file to find the cluster info of the point
	// Takes the latitude and longitude strings as input parameters and returns the cluster information.
	function runPointAnalysis($lat, $long){
		exec("SOAP/app/View/Results/src/PointAnalysis $lat $long" , $clusterInfo);
		return $clusterInfo;
	}
?>
