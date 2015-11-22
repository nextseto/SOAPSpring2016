<?php
	$lat = strip_tags($_POST[latitudeSearchBar]);
	$lon = strip_tags($_POST[longitudeSearchBar];
	
	echo ("Latitude:" .$lat. "<BR>Longitude:" .$lon.);
?>