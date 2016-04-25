<!-- Created by CSC 315 Team 4 fall 2015 
This file generates the view for the chemTransparency page. 
This file retreives information from the database on chemicals located in facilities/counties and 
presents the queried results. These results will be used for the generation of pie charts visualization of chemical percentages
and their potential health impacts, which does not work completly right now.  
-->

<!--This creates the dividers for the page -->
<div class="section">
  	<div class="container">
    	<div class="row">
      	<div class="col-md-12">
        	<h1>Chemical Transparency: Chemicals at Brownfields and their Health&nbsp;Impacts</h1>
      	</div>
    	</div>
    	<div class="row"></div>
  	</div>
	</div>
	<div class="section">
  	<div class="container">
    	<div class="row">
      	<div class="col-md-12">
      	         	 
        	<form action="#" method="#">
<center>
	<!--This is the fifth query: includes the header and the actual query -->
	<h1>Query 5:</h1>  
	   <p contenteditable="true" class="text-center"> List the Name, Address, Danger Level, and Company of a facility.</p><br>		
		<select>
			<?php
               	$query = "SELECT facility_name, location_id, dangerous_state
               	FROM newsoap.facilities 
               	JOIN newsoap.nn_data 
               		ON newsoap.nn_data.facility_id = newsoap.facilities.id
               	JOIN newsoap.owned_by 
               		ON newsoap.facilities.id = newsoap.owned_by.facility_id
               	JOIN newsoap.owners 
               		ON newsoap.owned_by.owner_id = newsoap.owners.id
               	JOIN newsoap.locations 
               		ON newsoap.facilities.location_id = newsoap.locations.id
                WHERE newsoap.facilities.facility_name = 'ECOLAB INC' ";

			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
			    while($myrow = pg_fetch_assoc($result)) {
			?>
			<option value='<?php echo(htmlspecialchars($myrow['facility_name'])); ?>'/>
				<?php echo(htmlspecialchars($myrow['facility_name']));?>
			</option>
			
			<option value='<?php echo(htmlspecialchars($myrow['location_id'])); ?>'/>
				<?php echo(htmlspecialchars($myrow['location_id']));?>
			</option>
			
			<option value='<?php echo(htmlspecialchars($myrow['dangerous_state'])); ?>'/>
				<?php echo(htmlspecialchars($myrow['dangerous_state']));?>
			</option>
			
			<?php
			    }
			?>
		</select>
	
	<!--This is the sixth query: includes the header and the actual query -->
<h1>Query 6:</h1>  
	<p>List all facilities in a county.</p>
		<select>
			<?php
               	$query = "SELECT facility_name
				FROM newsoap.facilities
				JOIN newsoap.locations ON newsoap.facilities.location_id=newsoap.locations.id
				WHERE newsoap.locations.county= 'SUSSEX'";
                    
			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
			    while($myrow = pg_fetch_assoc($result)) {
			?>
			<option value='<?php echo(htmlspecialchars($myrow['facility_name'])); ?>'/>
				<?php echo(htmlspecialchars($myrow['facility_name']));?>
			
			</option>
			
			<?php
			    }
			?>
		</select>
		
</center>	
   	 <!-- This is the code for the search bar and the toggle buttons -->
	</form>
        <div class="search-filter">
                <form id="searchBar">
                <input class="search-field" id="addressSearchBar" type="text" placeholder="Name...">
                <input type="submit" class="btn address-btn" value="Go" >
                </form>
                <br>
                <br>
                </div>
          	<br>
          	<br>
        	</div>
      	</div>
    	</div>
    	<div class="row">
      	<div class="col-md-12">
        	<form action="">
          	<input type="radio" id = "facility" class="Facility" name="display"> Facility
          	<br>
          	<input type="radio" id ="county" class="County" name="display"> County</form>
      	</div>
    	</div>
  	</div>
	</div>
	
	<script type="text/javascript" src="<?php echo $this->webroot; ?>/js/graph.js"></script>
	
	<div class="section">
  	<div class="container">
    	<div class="row">
      	<div class="col-md-12">
        	<p>Module Description.&nbsp;</p>

          	 <!-- This is the code for creating the first piechart -->
          	<div id="donutchart" style="width: 200%; height: 100%;"></div>
        	</div>
        	<div class="col-rt-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;">
          	
          	<!--chemical (county) pie chart-->
          	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
          	<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"], "callback": drawChart});
	google.setOnLoadCallback(drawChart);

	var chart;

	function drawChart() {

	var data = google.visualization.arrayToDataTable([
    ['Chemicals', 'Amount Present'],
    ['Chem1',     1],
    ['Chem2',      22],
    ['Chem3',  32],
    ['Chem4', 42],
    ['Chem5',    75]
	]);

	var options = {

    title: 'Carcinogenic Chemicals Present in County',
    pieHole: 0.4,
    legend: {position: 'bottom'},
    backgroundColor: 'transparent'
	};

	chart = new google.visualization.PieChart(document.getElementById('donutchart2'));

chart.draw(data, options);
}


$(document).ready(function(){
//On button click, load new data
$(".btn address-btn").click(function(){

    var data = google.visualization.arrayToDataTable(chemArray);

    var options = {
    title: 'Carcinogenic Chemicals Present in County',
    pieHole: 0.4,
    legend: {position: 'bottom'},
    backgroundColor: 'transparent'

    };    
    chart.draw(data, options);
    console.log("hello");

});
});
          	</script>
          
          </div>
          	<!-- This is the code for creating the second piechart -->
         <center>
          		<div id="donutchart2" style="width: 125%; height: 100%;"></div>
        </center>
          	
          	<div class="facility-details">
            	<h3>Facility Information:</h3>
            	<hr>
            	<!--?php echo $pieChart_info['facility_name']['location_id'][0][0]; ?-->
          	</div>
        	</div>
      	</div>
  	</div>
</div>
