<html>
<body>
<div class="container">

<?php
$lat = $_POST["lat"];
$lng = $_POST["lng"];

exec("/var/www/html/SOAP/app/View/Results/Clusters/pta.exe {$lat} {$lng}", $output, $return_var);

$numChems = array_pop($output);
$chemData = array_chunk($output, 3);

?>

<h1> <?php echo "{$numChems} Chemicals Estimated at Coordinates: {$lat}, {$lng}" ?> </h1>

<table class="table table-striped" style="padding: 0px" style="border-top: 0px" align="center" cellspacing="0" cellpadding="0">
<tr>
<thread>
<!-- Tooltip hover information for the Table headers - Joie Murphy-->
<th style="width:auto;"><a href="#" rel="tooltip" id="chemical_id" style="color: #F5F3DC" title="CAS ID of the chemical.">ID</a></th>
<th style="width:auto;"><a href="#" rel="tooltip" id="chemical_name" style="color: #F5F3DC" title="The known name of the chemical.">Name</a></th>
<th style="width:auto;"><a href="#" rel="tooltip" id="chemical_ta" style="color: #F5F3DC" title="The total release count of the chemical.">Releases</a></th>
</thead>
<?php 

foreach($chemData as $row) {
	echo('<tr>');
	echo('<td>');
	echo(implode('</td><td>', $row));
	echo('</td>');
	echo('</tr>');
} ?>
</tr>
</table>

</div>
</body>
</html>
