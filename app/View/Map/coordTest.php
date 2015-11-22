<?php
	$lat = strip_tags($_GET[latitudeSearchBar]);
	$lon = strip_tags($_GET[longitudeSearchBar];
	
	echo ("Latitude:" .$lat. "<BR>Longitude:" .$lon.);
?>