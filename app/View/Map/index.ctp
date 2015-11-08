<?php 
// Created by: Vitor Machado, Nathan Gould, and Curran Prassad
//
// index/ctp represents the main view file for the Map page. It is here that the information sent from the database
// by MapController.php is formatted for presentation to the user. it is also here that map.js is utilized in conjunction
// with the Google Maps API to generate the map itself. Certain considerations were made to ensure that coordinates
// retrieved from the database properly align with corresponding locations on the map.
//
/*
* Modified by: Angela Huang, Graham Robers, Dylan Wulf, and Trevor Fullman
* SE: Spring 2015
* Modified the layout of the search bar to include fields allowing users to filter by danger level (checkboxes),
* county (drop-down bar), and search by any address (search bar)
*/
	$this->Html->css('map', null, array('inline' => false));
	
	$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true', array('inline' => false));
	$this->Html->script('map', array('inline' => false));
	
	
	foreach($map_info as $facility) {
		// Only generate marker if there are coordinates to use for plotting
		if($facility[0]['x_coor'] != NULL && $facility[0]['y_coor'] != NULL) {
		
		//Pre-process x_coor and y_coor to prevent incorrect location marking
		$facilities[] = array(
			'id' => $facility[0]['id'],
			'facility_name' => $facility[0]['facility_name'],
			'x_coor' => floatval($facility[0]['x_coor']),
			'y_coor' => -1*floatval($facility[0]['y_coor']),
			'dg_level' =>	$facility[0]['dangerous_state'],
			'county' => $facility[0]['county'] //added this so we can search by county in the JS file --Dylan
			);
		}
	}
	
	//This part transforms the PHP array into a javascript array (accessible by window.app.facilities in map.js)
	$this->Js->set('facilities', $facilities);
	echo $this->Js->writeBuffer(array('inline' => false, 'onDomReady' => false, 'safe' => false));
?>
<head>
<!-- Sidebar content and Map page layout created by: Nathan Gould-->
<!--Modified by Angela Huang, Dylan Wulf, Graham Roberts to display extra search features and messaging-->
</head>

<!--Added a section for the map page messaging written by Devon, Steph A., and Steph V. (Journalism Class)-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Welcome to SOAP's Map Feature</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p contenteditable="true" class="text-center">Please search for properties by name or location in the search bar on
                            the left. Click on a coordinate data point located on the map for specific
                            information about the site, including contaminates and location. View demographic
                            information, such as local minority percentage and income level, by clicking
                            the button above the map on the left.</p><br>
                    </div>
                </div>
            </div>
        </div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3 search-wrapper" >
    			
			<div class="search-filter">
				<h2>Go to Address:</h2>
					<input class="search-field" id="addressSearchBar" type="text" placeholder="Go to address...">

					<input type="button" class="btn address-btn" value="Go"><br><br>
                                <h2>Search Coordinates:</h2>
					<input class="search-field" id="addressSearchBar" type="text" placeholder="Latitude"> <br><br>
                                        <input class="search-field" id="addressSearchBar" type="text" placeholder="Longitude"> <br> <br>
					<input type="button" class="btn address-btn" value="Search"> <input type="button" class="btn address-btn" value=" Use Current Location"><br><br>
				<h2>Search Facilities:</h2>
					<input class="search-field" id="mainSearchBar" type="text" placeholder="Enter facility name...">
					<input type="button" class="btn search-btn" value="Search" /><br><br>
				
				<h2>Filter by County:</h2>
				
				<select name="County" onchange="filterByCounty(this.value)">
					<option value="ALL_COUNTIES">---------</option>
					<option value="Atlantic">Atlantic</option>
					<option value="Bergen">Bergen</option>
  					<option value="Burlington">Burlington</option>
					<option value="Camden">Camden</option>
  					<option value="Cape May">Cape May</option>
					<option value="Cumberland">Cumberland</option>
					<option value="Essex">Essex</option>
  					<option value="Gloucester">Gloucester</option>
  					<option value="Hudson">Hudson</option>
  					<option value="Hunterdon">Hunterdon</option>
  					<option value="Mercer">Mercer</option>
  					<option value="Middlesex">Middlesex</option>
					<option value="Monmouth">Monmouth</option>
					<option value="Morris">Morris</option>
  					<option value="Ocean">Ocean</option>
  					<option value="Passaic">Passaic</option>
  					<option value="Salem">Salem</option>
					<option value="Somerset">Somerset</option>
					<option value="Sussex">Sussex</option>
  					<option value="Union">Union</option>
  					<option value="Warren">Warren</option>
  					
				</select><br><br>
				
				<h2>Filter by Danger Level:</h2>
				
				<center> <form action="">
					<div id="levels">
					<input type="checkbox" class="dangerLevel" name="level1">  1
					<input type="checkbox" class="dangerLevel" name="level2">  2
					<input type="checkbox" class="dangerLevel" name="level3">  3
					<input type="checkbox" class="dangerLevel" name="level4">  4
					<input type="checkbox" class="dangerLevel" name="level5">  5
					</div>
				</form></center>
			</div>
			
			<h2 align="center">Facilities List:</h2>
			<ul>
			<?php 
				foreach($facilities as $facility):
				
					$imgType = "";
					
					switch ($facility['dg_level']) {
						case '1':
							$imgType = "GreenFactoryIcon.png";
							break;
						case '2':
							$imgType = "YellowFactoryIcon.png";
							break;
						case '3':
							$imgType = "OrangeFactoryIcon.png";
							break;
						case '4':
							$imgType = "Red2FactoryIcon.png";
							break;
						case '5':
							$imgType = "RedFactoryIcon.png";
							break;
					}
			?>
				<li id="<?php echo $facility['id']; ?>" class="facility-list-item"><img src="/SOAP/app/webroot/img/map/<?php echo $imgType; ?>" class="dg-level"><?php echo $facility['facility_name']; ?></li>
			<?php endforeach;	?>
			</ul>
    		</div>
    		<div class="span9 map-wrapper">
			<div id="map_canvas" style="width:100%; height:80vh"></div>
    		</div>
  	</div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">							
		  	
			</div>
		<div class="modal-footer"></div>
    </div>
  </div>
</div>