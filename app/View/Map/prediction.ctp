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
	This file contains HTML code for the modal that pops up for the prediction algorithm.
	The file is opened by the prediction() function of the SOAP/app/Controller/MapController.php, but 
	does not currently load.  Future teams should add to this file for appropriate formatting of the
	modal once the loading issue has been solved.
 -->
 
-->

<div>
	<h3>Prediction Details:</h3>
	<hr>
	<span><strong>Latitude:</strong><?php echo $latitude[0]['latitude']; ?><br/></span>
	<span><strong>Longitude:</strong><?php echo $longitude[0]['longitude']; ?><br/></span>
	<span><strong>Prediction:</strong><br/></span>
  <br/>
</div>  