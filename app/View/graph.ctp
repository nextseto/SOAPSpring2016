<!-- Created by CSC 315 Team 4 fall 2015
This file generates the View for the graphs page. 
This file retrieves information from the database on chemicals located in facilities/counties and 
presents the queried results. These results will be used for the generation of pie charts for 
visualization of chemical percentages and their potential health impacts. 
-->

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

<!--Query 1: Find the names of all chemicals and their total_amounts present in a facility.-->
			<?php
				$db = pg_connect('host=localhost port=5432 dbname=soap user=postgres password=cabect'); 
			
               	$query = "SELECT chemical_name, to_number(SPLIT_PART(total_amount, ' ',1),'999999.99')
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                        	ON newsoap.facilities.id = facility.facility_id
                        WHERE newsoap.facilities.facility_name = 'ECOLAB INC' 
                        	AND facility.total_amount > '0 Pounds'";
                    
			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
				$heading = array ('Chemical Name', 'Chemical Amount');
				$chemInfo = array($heading);
			    while($myrow = pg_fetch_row($result)) {
			    $myrow[1]=(float)$myrow[1];
			    array_push($chemInfo, $myrow);
			?>
			<?php
			    }
			?>

<!--Query 2: Find the names of all carcinogenic chemicals and their total amounts in a facility.-->
			<?php
               	$query = "SELECT chemical_name, to_number(SPLIT_PART(total_amount, ' ',1),'999999.99')
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                        	ON newsoap.facilities.id = facility.facility_id
                        WHERE carcinogenic = 'Yes' 
                       		AND facility.total_amount > '0 Pounds'
                       		AND newsoap.facilities.facility_name = 'BL ENGLAND GENERATING STATION'";
                    
			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
				$carcinogenicInfo = array($heading);
			    while($myrow = pg_fetch_row($result)) {
			    	$myrow[1]=(float)$myrow[1];
			    	array_push($carcinogenicInfo, $myrow);
			?>
			<?php
			    }
			?>
			
<!--Query 3: Find the names of all chemicals and their total amounts in a county.-->
			<?php
               	$query = "SELECT chemical_name, SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99'))
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                        	ON newsoap.facilities.id = facility.facility_id
                        JOIN newsoap.locations ON newsoap.facilities.location_id=newsoap.locations.id
                        WHERE newsoap.locations.county = 'ESSEX' 
                        	AND facility.total_amount > '0 Pounds'
                        GROUP BY chemical_name
                        HAVING SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99' )) > 0
						ORDER BY chemical_name
						LIMIT 12";
                
                $countyChemicals = array($heading);
			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
			    while($myrow = pg_fetch_row($result)) {
			    	$myrow[1]=(float)$myrow[1];
			     	array_push($countyChemicals, $myrow);
			?>
			<?php
			    }
			?>
			
<!--Query 4: Find the names of all carcinogenic chemicals and their total amounts in a county.-->
			<?php
               	$query = "SELECT chemical_name, SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99'))
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                        	ON newsoap.facilities.id = facility.facility_id
                        JOIN newsoap.locations ON newsoap.facilities.location_id=newsoap.locations.id
                        WHERE newsoap.locations.county = 'ESSEX' 
                        	AND carcinogenic = 'Yes'
                        	AND facility.total_amount > '0 Pounds'
                        GROUP BY chemical_name
                        HAVING SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99' )) > 0
						ORDER BY chemical_name
						LIMIT 12";
                
                $countyCarcinogenic = array($heading);
			    $result = pg_query($query);
			    if (!$result) {
			    	echo "Problem with query " . $query . "<br/>";
			    	echo pg_last_error();
			    	exit();
				}
			    while($myrow = pg_fetch_row($result)) {
			    	$myrow[1]=(float)$myrow[1];
			     	array_push($countyCarcinogenic, $myrow);
			?>
			<?php
			    }
			?>
<br>	
</center>	
   	 
	</form>
<!-- Generates a search bar for users to search for a facility or a county -->

        	<h2>Search</h2>
        	<div class="search-filter">
          	<input class="search-field" id="addressSearchBar" type="text" placeholder="Name...">
          	<input type="button" class="btn address-btn" value="Go">
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
	<div class="section">
  	<div class="container">
    	<div class="row">
      	<div class="col-md-12">

        	<div class="col-md-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;"></div>
        	<div class="col-rt-12" style="float: left; width: 60%; margin-right: 1%; margin-bottom: 0.5em;">
          	<!--chemical(facility) pie chart-->
          	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
          	<script type="text/javascript">
          	
          		var chemArray= <?php echo json_encode($chemInfo);?>;
            	google.load("visualization", "1", {packages:["corechart"]});
                	google.setOnLoadCallback(drawChart);
                	function drawChart() {
                  	var data = google.visualization.arrayToDataTable(chemArray);
                  	var options = {
                    	title: 'Chemicals Present in Facility',
                    	pieHole: 0.4,
                      	legend: {position: 'bottom'},
                       	backgroundColor: 'transparent'
                  	};
                  	var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                  	chart.draw(data, options);
                	}
          	</script>
          	
          	<div class="col-md-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;"></div>
        	<div class="col-rt-12" style="float: left; width: 60%; margin-right: 1%; margin-bottom: 0.5em;">
          	<!--carcinogenic chemical(facility) pie chart-->
          	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
          	<script type="text/javascript">
          	
          		var carcinogenArray= <?php echo json_encode($carcinogenicInfo);?>;
            	google.load("visualization", "1", {packages:["corechart"]});
                	google.setOnLoadCallback(drawChart);
                	function drawChart() {
                  	var data = google.visualization.arrayToDataTable(carcinogenArray);
                  	var options = {
                    	title: 'Carcinogenic Chemicals Present in Facility',
                    	pieHole: 0.4,
                      	legend: {position: 'bottom'},
                       	backgroundColor: 'transparent'
                  	};
                  	var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
                  	chart.draw(data, options);
                	}
          	</script>
          	
          	<div id="donutchart" style="width: 200%; height: 100%;"></div>
        	</div>
        	<div class="col-rt-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;">
          	
          	<!--chemical (county) pie chart-->
          	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
          	<script type="text/javascript">
          	
          		var countyChemArray= <?php echo json_encode($countyChemicals);?>;
            	google.load("visualization", "1", {packages:["corechart"]});
                	google.setOnLoadCallback(drawChart);
                	function drawChart() {
                  	var data = google.visualization.arrayToDataTable(countyChemArray);
                  	var options = {
                    	title: 'Chemicals Present in County',
                    	pieHole: 0.4,
                      	legend: {position: 'bottom'},
                       	backgroundColor: 'transparent'
               	 
                  	};
                  	var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
                  	chart.draw(data, options);
                	}
          	</script>
          	
          	<div class="col-md-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;"></div>
        	<div class="col-rt-12" style="float: left; width: 60%; margin-right: 1%; margin-bottom: 0.5em;">
          	<!--carcinogenic chemical (county) pie chart-->
          	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
          	<script type="text/javascript">
          	
          		var countyChemCarArray= <?php echo json_encode($countyCarcinogenic);?>;
            	google.load("visualization", "1", {packages:["corechart"]});
                	google.setOnLoadCallback(drawChart);
                	function drawChart() {
                  	var data = google.visualization.arrayToDataTable(countyChemCarArray);
                  	var options = {
                    	title: 'Carcinogenic Chemicals Present in County',
                    	pieHole: 0.4,
                      	legend: {position: 'bottom'},
                       	backgroundColor: 'transparent'
               	 
                  	};
                  	var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
                  	chart.draw(data, options);
                	}
          	</script>
          	</div>
          	
         <center>
          		<div id="donutchart" style="width: 125%; height: 100%;"></div>
          		<div id="donutchart2" style="width: 125%; height: 100%;"></div>
          		<div id="donutchart3" style="width: 125%; height: 100%;"></div>
          		<div id="donutchart4" style="width: 125%; height: 100%;"></div> 
        </center>
<br>
          	<div class="facility-details">
            	<h3>Facility Information:</h3>
            	 	<hr>
            	<p>Facility Name: ECOLAB INC&nbsp;</p>
				<p>Facility Name: BL ENGLAND GENERATING STATION&nbsp;</p>
				<p>County Name: ESSEX&nbsp;</p>
				<p>County Name: ESSEX&nbsp;</p>
          	</div>
        	</div>
      	</div>
    	</div>
  	</div>
	</div>
</div>
