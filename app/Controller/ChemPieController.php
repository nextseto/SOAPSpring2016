<?php
//Created by Team 4 CSC315-Database Systems Fall 2015
//This file Queries the database for info on chemicals/carcingens present at facilities/counties. 
//The results are sent to graph.js
Class ChemPieController extends AppController {
    //run the queries to find the chemical amounts and carcinogenic amounts in a facility or county
        public $components = array('RequestHandler');
        public function index(){
        $type='facility';
        $searchValue= 'value';
        $data = $this->request->data;
       $searchValue = $data['searchValue'];
       $type = $data['type'];
        $db = pg_connect('host=localhost port=5432 dbname=soap user=postgres password=cabect');
        //execute queries depending on whether user specified a facility or county
        if($type == "facility"){
            //FACLILITY QUERIES
            //query 1: Find the names of all chemicals and their total_amounts present in a facility
            $query = "SELECT chemical_name, to_number(SPLIT_PART(total_amount, ' ',1),'999999.99')
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                                ON newsoap.facilities.id = facility.facility_id
                        WHERE newsoap.facilities.facility_name = '$searchValue'
                                AND facility.total_amount > '0 Pounds'";
             $chem_info = $this->Chemical->query($query);
        	 $this->set('chem_info', $chem_info);
            $result = pg_query($query);
                            if (!$result) {
                                echo "Problem with query " . $query . "<br/>";
                                echo pg_last_error();
                                exit();
                                }
                                $heading = array ('Chemical Name', 'Chemical Amount');
                                $chemArray = array($heading);
                            while($myrow = pg_fetch_row($result)) {
                            if (!$result) {
                                echo "Problem with query " . $query . "<br/>";
                                echo pg_last_error();
                                exit();
                                }
                                $heading = array ('Chemical Name', 'Chemical Amount');
                                $chemArray = array($heading);
                            while($myrow = pg_fetch_row($result)) {
                            $myrow[1]=(float)$myrow[1];
                            array_push($chemArray, $myrow);
                }
                //query 2
            $query = "SELECT chemical_name, to_number(SPLIT_PART(total_amount, ' ',1),'999999.99')
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                                ON newsoap.facilities.id = facility.facility_id
                        WHERE carcinogenic = 'Yes' 
                                AND facility.total_amount > '0 Pounds'
                                AND newsoap.facilities.facility_name ='$searchValue' ";
            
                            $result = pg_query($query);
                            if (!$result) {
                                echo "Problem with query " . $query . "<br/>";
                                echo pg_last_error();
                                exit();
                                }
                                $carcinogenArray = array($heading);
                            while($myrow = pg_fetch_row($result)) {
                                $myrow[1]=(float)$myrow[1];
                                array_push($carcinogenArray, $myrow);
                }
        }
        else{
         //COUNTY QUERIES
            $heading = array ('Chemical Name', 'Chemical Amount');
            //Query 3: Find the names of all chemicals and their total amounts in a county
           $query = "SELECT chemical_name, SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99'))                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                                ON newsoap.facilities.id = facility.facility_id
                        JOIN newsoap.locations ON newsoap.facilities.location_id=newsoap.locations.id
                        WHERE newsoap.locations.county = '$searchValue'
                                AND facility.total_amount > '0 Pounds'
                        GROUP BY chemical_name
                        HAVING SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99' )) > 0
                                                ORDER BY chemical_name";
                $chemArray = array($heading);
                            $result = pg_query($query);
                            if (!$result) {
                                echo "Problem with query " . $query . "<br/>";
                                echo pg_last_error();
                                exit();
                                }
                            while($myrow = pg_fetch_row($result)) {
                                $myrow[1]=(float)$myrow[1];
                                array_push($chemArray, $myrow);
                }
            //carcinogenic chemicals by county
            $query = "SELECT chemical_name, SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99'))
                        FROM newsoap.facilities
                        JOIN (newsoap.contains JOIN newsoap.chemicals ON newsoap.contains.chemical_id = newsoap.chemicals.id) as facility 
                                ON newsoap.facilities.id = facility.facility_id
                        JOIN newsoap.locations ON newsoap.facilities.location_id=newsoap.locations.id
                        WHERE newsoap.locations.county = '$searchValue'
                                      AND carcinogenic = 'Yes'
                                AND facility.total_amount > '0 Pounds'
                        GROUP BY chemical_name
                        HAVING SUM(to_number(SPLIT_PART(total_amount, ' ',1),'999999.99' )) > 0
                                                ORDER BY chemical_name";
                $carcinogenArray = array($heading);
                            $result = pg_query($query);
                            if (!$result) {
                                echo "Problem with query " . $query . "<br/>";
                                echo pg_last_error();
                                exit();
                                }
                            while($myrow = pg_fetch_row($result)) {
                                $myrow[1]=(float)$myrow[1];
                                array_push($carcinogenArray, $myrow);
                }
           }
        //return the results of the queries to the graph.ctp page                                                        95,1          71%
        if($this->RequestHandler->isAjax()){
           // $queryResult = array($chemArray, $carcinogenArray, $infoArray);
        	$queryResult = array($chemArray, $carcinogenArray);
            return new CakeResponse(array('body' => json_encode($queryResult)));
        }
    }
    
}
?>
