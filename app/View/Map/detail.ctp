<!--
Created by: Vitor Machado
File detail.ctp represents the html code which formats the details pop-up (the pop-up that is shown when a marker is clicked).
Information set by function detail() in MapController.php through database calls are formatted here for presentation to the user -
specific variables which are sent from the controller to detail.ctp include the $facility_info[] array as well as the $chem[] array.
-->

<!--
Modified by Angela Huang, Graham Roberts, and Dylan Wulf to include Demographics Information. 
-->

<div class="facility-details">
	<h3>Facility Details:</h3>
	<hr>
	<span><strong>Name:</strong> <?php echo $facility_info[0][0]['facility_name']; ?><br/></span>
	<span><strong>Parent Company:</strong> <?php echo $facility_info[0][0]['owner_name']; ?><br/></span>
	<span style="float: left; width: 50%;"><strong>Danger Level:</strong><?php echo $facility_info[0][0]['dangerous_state']; ?> (out of 5)<br/></span>
	<span><strong>Brownfield:</strong> <?php echo $facility_info[0][0]['is_brownfield']; ?><br/></span>
  <br/>
</div>      	
<div class="location-details">
	<h3>Location details:</h3>
	<hr>
	<span><strong>Street Address:</strong> <?php echo $facility_info[0][0]['location_id']; ?><br/></span>
	<span style="float: left; width: 50%;"><strong>County:</strong> <?php echo $facility_info[0][0]['county']; ?><br/></span>
	<span><strong>Municipality:</strong> <?php if($facility_info[0][0]['municipality'] == null) echo "N/A"; else echo $facility_info[0][0]['municipality']; ?><br/></span>
  <div style="float: left; width: 50%;">
		<span><strong>Latitude:</strong> <?php echo (($facility_info[0][0]['latitude'] == null) ? "N/A" : $facility_info[0][0]['latitude']); ?><br/></span>
		<span><strong>Longitude:</strong> <?php echo (($facility_info[0][0]['longitude'] == null) ? "N/A" : $facility_info[0][0]['longitude']); ?><br/></span>
	</div>
	<div style="float: left; width: 50%;">
		<span><strong>X Coordinate:</strong> <?php echo (($facility_info[0][0]['x_coor'] == null) ? "N/A" : $facility_info[0][0]['x_coor']); ?><br/></span>
		<span><strong>Y Coordinate:</strong> <?php echo (($facility_info[0][0]['y_coor'] == null) ? "N/A" : $facility_info[0][0]['y_coor']); ?><br/><br/></span>
	</div>				  
</div>
<!--demographics section added by Graham Roberts (HTML formatting) and Angela Huang (Retrieval of Percentages from Database)-->
<div class="population-details">
	<h3>Demographic data:</h3>
	<hr>
	<span><strong>Percetage of Minorities (within a 3 Mile Radius):</strong> <?php echo (($facility_info[0][0]['percent_minority'] == null) ? "N/A" : $facility_info[0][0]['percent_minority']); ?><br/><br/></span>
</div>
<div class="chemicals-details">
	<h3>Chemicals found on-site:</h3>
	<hr>
	<?php foreach ($chem_info as $chem): ?>
		<h4><a href="/SOAP/index.php/chemicals/view/<?php echo $chem[0]['chemical_id']; ?>" class="page-link"><?php echo $chem[0]['chemical_name']; ?></a></h4>
		<span style="float: left; width: 50%;"><strong>Total Amount:</strong> <?php echo $chem[0]['total_amount']; ?></span>
		<span><strong>Fugitive Air Amount:</strong> <?php echo $chem[0]['fugair_amount']; ?></span><br/>
		<span style="float: left; width: 50%;"><strong>Water Amount:</strong> <?php echo $chem[0]['water_amount']; ?></span>
		<span><strong>Stack Air Amount:</strong> <?php echo $chem[0]['stackair_amount']; ?></span><br/>
	<?php endforeach; ?>
</div>


