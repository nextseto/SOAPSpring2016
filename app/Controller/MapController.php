<?php
// Created by: Nathan Gould
// 
// The MapController class primarily is responsible for queries to the database on behalf of the Map page's view. Appropriate
// information is retrieved from the database and sent to the view (index.ctp located in .../app/View/Map/). This same process
// is used for the dynamic generation of the details infographic which is displayed when a facility marker is clicked by the user.
//

/**
 * Modified by: Angela Huang, Dylan Wulf, Trevor Fullman, and Graham Roberts to include the retrieval of demographic information 
 * to be displayed within the details box. 
 * 
 */

/**
 *Name: Evan Melquist, Zachary Nelson, Richard Levenson, Jeremy Leon and Hunter Dubel
 *Course: CSC 415
 *Semester: Fall 2015
 *Instructor: Dr. Pulimood
 *Project Name: Pollution Prediction
 *Commented out percent_minority field to prevent error in SOAP server integration.
 *Filename: MapController.php
 *Last Modified On: 11/23/15 by Richard Levenson, Jeremy Leon, and Evan Melquist
 * 
 */
 
class MapController extends AppController {

	public $components = array('RequestHandler');
	var $uses = array('Facility');

	public function index() {
		$map_sql = 'SELECT f.id,f.facility_name,l.x_coor,l.y_coor, n.dangerous_state, l.county FROM facilities f,locations l, nn_data n WHERE f.location_id = l.id AND n.facility_id = f.id';
		$map_info = $this->Facility->query($map_sql);
		$this->set('map_info', $map_info);
	}	

	//percent_minority data was added to the vitual machine database server ubuntu@172.16.100.43 and will need to be integrated with the main SOAP server for the information to be retrieved
	//percent_minority commented out to prevent error
	public function detail($facility_id) {
		
		$facility_sql = 'SELECT facility_name, owner_name, dangerous_state, is_brownfield, location_id, county, municipality, latitude, longitude, x_coor, y_coor--, percent_minority
                        FROM "newsoap"."facilities"
                        JOIN "newsoap"."locations" ON "newsoap"."facilities".location_id = "newsoap"."locations".id
                        JOIN ("newsoap"."owned_by" JOIN "newsoap"."owners" ON "newsoap"."owned_by".owner_id = "newsoap"."owners".id) as owned ON "newsoap"."facilities".id = owned.facility_id
                        JOIN "newsoap"."nn_data" ON "newsoap"."facilities".id = "newsoap"."nn_data".facility_id
                        WHERE "newsoap"."facilities".id = \'' . $facility_id . '\';';
		$facility_info = $this->Facility->query($facility_sql);
		$this->set('facility_info', $facility_info);
		$chem_sql = 'SELECT chemical_id, chemical_name, total_amount, fugair_amount, water_amount, stackair_amount
                    FROM "newsoap"."facilities"
                    JOIN ("newsoap"."contains" JOIN "newsoap"."chemicals" ON "newsoap"."contains".chemical_id = "newsoap"."chemicals".id) as chem ON "newsoap"."facilities".id = chem.facility_id
                    WHERE chem.facility_id = \'' . $facility_id . '\' ORDER BY chemical_name;';
		$chem_info = $this->Facility->query($chem_sql);
		$this->set('chem_info', $chem_info);
		
		
		$this->layout = 'ajax';
		$this->render('detail');
	}

	//function to display prediction popup
	public function prediction(){
		$this->layout = 'ajax';
		$this->render('/map/prediction.ctp');
	}

	//This function is no longer used, since filtering is now done through javascript. 
	//But we will leave it here in case a future group wants to use it.	
	public function filter($filter_criteria = "") {
		
		$filter_criteria = strtolower($filter_criteria);
		
		$filter_query = "SELECT 
  			f.id, 
  			f.facility_name,
  			l.x_coor, 
  			l.y_coor,
  			n.dangerous_state
		
			FROM 
  			newsoap.facilities f
			JOIN newsoap.locations l ON f.location_id = l.id
			JOIN newsoap.nn_data n ON n.facility_id = f.id
			WHERE
			lower(f.location_id) LIKE '%$filter_criteria%' OR
			lower(f.facility_name) LIKE '%$filter_criteria%'";
		
		$facilities = $this->Facility->query($filter_query);
		$this->set('facilities', $facilities);
		
		
		$this->layout = 'ajax';
		$this->render('filter');
	}
}
?>
