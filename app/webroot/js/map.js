/*
 * Created by: Vitor Machado
 *
 * map.js represents the code reponsible for generating the map seen on the Map page. The map is initialized at the current 
 * latitude and logitude of the user's location. Information regarding the x and y coordinates necessary for creating the markers
 * are gathered from the window.app.facilities variable. Main functionality of the Javascript seen here can be traced by the 
 * $(document).ready block seen at the bottom of the file. 
*/

/*
 * Modified by: Dylan Wulf, Graham Roberts, Angela Huang, and Trevor Fullman 
 *
 * SE: Spring 2015
 *
 * map.js now includes a function filterbyCounty() that allow users to filter the map by selecting a County. Once a County is selected,
 * the map will pan and zoom into the corresponding county. Only markers associated with the County selected will be displayed.
 * The filterbyDangerLevel() function allows users to check boxes corresponding to danger levels from 1-5, and the facility markers 
 * corresponding to the danger levels that are checked are set to visible. A search by address bar was also included in the index.php file 
 * and the funcitonality is implemented in the gotoAddress() function, allowing users to search the map by any address. Basic search functionality
 * was also improved, allowing users to search by either a mouse click or enter key. 
*/

/*
 *Name: Evan Melquist, Zachary Nelson, Richard Levenson, Jeremy Leon and Hunter Dubel
 *Course: CSC 415
 *Semester: Fall 2015
 *Instructor: Dr. Pulimood
 *Project Name: Pollution Prediction
 *Description: Added function nonSitePredictor() to make an action when the latitude/longitude search button is pressed.
 *Filename: map.js
 *Last Modified On: 11/23/15 by Hunter Dubel
 */


var map;
var mapOptions;
var facilities;
var markers = {};

var filterCounty = "ALL_COUNTIES";
var filterFacilityName = "";
var dgLevelsVisible = [true, true, true, true, true];
var geocoder;  //for zoom and address search

function initialize(wrapperId, mapOptions) {
  geocoder = new google.maps.Geocoder();  //For zoom and address search
  map = new google.maps.Map(document.getElementById(wrapperId), mapOptions);

  //Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      mapOptions.initialPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);        
      setInitialPosition(mapOptions);
      map.setCenter(mapOptions.initialPosition);
      
    }, function() {
      handleNoGeolocation(mapOptions);
    });
  } else {
    handleNoGeolocation(mapOptions);
  }
}

function handleNoGeolocation(mapOptions) { 
  map.setCenter(mapOptions.center);
  map.setZoom(8);
}

//Finds lat/long of address and centers map on it
//Added by Trevor Fullman
function codeAddress(address) {     
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
      } else {
        console.log("Geocode was not successful for the following reason: " + status);
      }
    });
  }

function setInitialPosition(mapOptions) {
  
  var infowindow = new google.maps.InfoWindow({
      content: mapOptions.currentPositionLabel
  });
  
  marker = new google.maps.Marker({
      position: mapOptions.initialPosition,
      map: map,
      icon: mapOptions.initialPositionImage,
      title: mapOptions.currentPositionLabel
  });
  
}

function setFacilityMarker(facilityInfo) {
  var facilityPosition = new google.maps.LatLng(facilityInfo.x_coor, facilityInfo.y_coor)
  
  var iconType;
  
  switch (facilityInfo.dg_level) {
    case '1':
      iconType = "GreenFactoryFinal.png";
      break;
      
    case '2':
      iconType = "YellowFactoryFinal.png";
      break;
      
    case '3':
      iconType = "OrangeFactoryFinal.png";
      break;
      
    case '4':
      iconType = "Red2FactoryFinal.png";
      break;
      
    case '5':
      iconType = "RedFactoryFinal.png";
      break;
  }
  
  var marker = new google.maps.Marker({
    position: facilityPosition,
    map: map,
    icon: '/SOAP/app/webroot/img/map/'+iconType,
    title: facilityInfo.facility_name
  });
  
  marker.facilityId = facilityInfo.id;
  
  markers[facilityInfo.id] = marker;

  google.maps.event.addListener(marker, 'click', pullDetails);
}

// Creators: Nathan Gould and Vitor Machado
// Function which pulls the details of a given facilityId or the marker's details if clicked
// from a marker on the map instead.
function pullDetails(inputId) {
    if(typeof inputId == 'string' || inputId instanceof String) {
    	    realFacilityId = inputId;
    }
    else {
    	    realFacilityId = this.facilityId
    }
    $('#mapModal').modal('show');
    $.ajax({
      type: 'get',
      url: location.origin + '/SOAP/app/webroot/index.php/map/detail/'+ realFacilityId,
      beforeSend: function() {
        $("div#mapModal div.modal-body").empty();
        $("div#mapModal div.modal-body").addClass("loading");
      },
      success: function(response) {
        $("div#mapModal div.modal-body").removeClass("loading");
        $("div#mapModal div.modal-body").append(response);
      }
    });
}


//Sets handlers for checkbox clicks and sets all boxes to be checked
function checkboxSetup() {

    // get reference to checkboxes
    var dgCheckboxes = document.getElementsByClassName('dangerLevel');
    
    // set handler function for clicks on danger level checkboxes
    for (var i=0; i<dgCheckboxes.length; i++) {
        dgCheckboxes[i].checked = true;
        dgCheckboxes[i].onclick = function() {updateMapDangerLevel()};
    }
}

//Looks at danger level checkboxes and filters map according
//to which ones are checked
function updateMapDangerLevel(){
    var dgCheckboxes = document.getElementsByClassName('dangerLevel');
    for (var i = 0; i < dgLevelsVisible.length; i++) 
        dgLevelsVisible[i] = dgCheckboxes[i].checked;
    filterFacilities();
}

//Filters facilities according to county name
//Added by Dylan Wulf and Trevor Fullman
function filterByCounty(county){
    filterCounty = county.toUpperCase();
    filterFacilities();

    if (county != "ALL_COUNTIES"){
        var countyAddress = county + " County, New Jersey, USA";  //Adds full name to County String
        codeAddress(countyAddress);  //Send county to be zoomed
        map.setZoom(11);
    }
    else {
        map.setCenter(mapOptions.initialPosition);
        map.setZoom(8);   //set new zoom level
    }
}

//Centers the map on the user-entered address and zooms in.
//If nothing is entered, zooms out and centers on initial position (Trenton, NJ)
function goToAddress(){
    var userAddress = document.getElementById("addressSearchBar").value;
    if (userAddress != ""){
        codeAddress(userAddress);
        map.setZoom(15);
    }
    else{
        map.setCenter(mapOptions.initialPosition);
        map.setZoom(8);
    }
}

//Centers the map on the user's current location
//If nothing is entered, zooms out and centers on initial position (Trenton, NJ)
//SE Fall 2015
//Zach Nelson & Hunter Dubel
function goToCurrLoc(){
    var currentLocation = document.getElementById("addressSearchBar").value;
    if (userAddress != ""){
        codeAddress(userAddress);
        map.setZoom(15);
    }
    else{
        map.setCenter(mapOptions.initialPosition);
        map.setZoom(8);
    }
}


//Predicts the pollution at a location that is not a known facility
//Added Evan Melquiste, Jeremy Leon, and Richard Levenson
//Modified by Hunter Dubel
function nonSitePredictor() {
	var latitude = document.getElementById("latitudeSearchBar").value;
	var longitude = document.getElementById("longitudeSearchBar").value;
	
	if(latitude !== "" && longitude !== "") {
		    $('#mapModal').modal('show');
    $.ajax({
      type: 'get',
      url: location.origin + '/SOAP/app/webroot/index.php/map/detail/',
      beforeSend: function() {
        $("div#mapModal div.modal-body").empty();
        $("div#mapModal div.modal-body").addClass("loading");
      },
      success: function(response) {
        $("div#mapModal div.modal-body").removeClass("loading");
        $("div#mapModal div.modal-body").append(response);
      }
    });
	} else {
		confirm("Please enter a valid longitude and latitude.");
	}
}


//Looks through every object in the facilities array and sets it to visible or 
//not visible according to filter parameters (filterCounty and dgLevelsVisible)
//Added by Dylan Wulf
function filterFacilities(){
    for(var i = 0; i < facilities.length; i++) {
        var marker = markers[facilities[i].id];
        var countyMatches = (filterCounty == "ALL_COUNTIES") || (facilities[i].county == filterCounty);
        var dgLevelMatches = dgLevelsVisible[parseInt(facilities[i].dg_level) - 1] == true;
        var nameMatches = (filterFacilityName == "") || (facilities[i].facility_name.indexOf(filterFacilityName) > -1);
        if(countyMatches && dgLevelMatches && nameMatches){
	    if (!marker.getVisible()){
                marker.setVisible(true);
                document.getElementById(facilities[i].id).style.display = "";
	    }
        }
        else{
            marker.setVisible(false);
            document.getElementById(facilities[i].id).style.display = "none";
        }
    }
}

//No longer used, but I'll leave it here in case someone in the future
//wants to use it.
function facilityNameSearchByAjax () {
  	var filter = $('#mainSearchBar').val();
    
    $.ajax({
      type: 'get',
      url: location.origin + '/SOAP/app/webroot/index.php/map/filter/'+ filter,
      success: function(response) {
        $(".search-wrapper ul").empty();
        $(".search-wrapper ul").append(response);
      }
    });
  }

//Filter map and facilities list by facility name
function facilityNameSearch(){
    filterFacilityName = $('#mainSearchBar').val().toUpperCase();
    filterFacilities();
}

$(document).ready(function(e){
  mapOptions = {
    center: new google.maps.LatLng(40.2679, -74.779), //Default location: NJ, USA
    zoom: 8,
    initialPositionImage: 'http://google-maps-icons.googlecode.com/files/home.png',
    currentPositionLabel: 'Current Position',
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  initialize("map_canvas", mapOptions);
  
  facilities = window.app.facilities; //window.app.facilities is created in View/Map/index.ctp
  
  for (i = 0; i < facilities.length; i++) { 
    setFacilityMarker(facilities[i]);
  }
  
  //When a facility in the list is clicked, center the map on that facility, 
  //set the zoom, and trigger a click event on the facility map marker 
  //(this results in a call to pullDetails, defined above) 
  $(document).on("click", "li.facility-list-item", function(e) {
      var facilityId = $(this).attr("id");
      
      map.setCenter(markers[facilityId].getPosition());
      map.setZoom(15);
      
      e.stopPropagation();
      e.preventDefault();
      
      new google.maps.event.trigger(markers[facilityId], 'click');
    });

  //Set up checkboxes to be checked when the page loads
  //And set up event handlers for checkboxes
  checkboxSetup();
  
  //
  $('.latlong-btn').click(function(e) {
    nonSitePredictor();
  });
  
  //Call goToAddress() when address button is pressed
  $('.address-btn').click(function(e) {
    goToAddress();
  });


  //Call handleNoGeoLocation() when address button is pressed
  //
  $('.currentlocation-btn').click(function(e) {
    handleNoGeolocation(mapOptions);
  });


  //call goToAddress() when enter key is pressed on addressSearchBar
  $('#addressSearchBar').keypress(function(e) {
    if (e.which == 13) goToAddress();
  });

  //Call facilityNameSearch() when search button is pressed
  $('.search-btn').click(function(e) {
	facilityNameSearch();
  });
  
   //Call facilityNameSearch() when enter key is pressed on facility name search bar
   $('#mainSearchBar').keypress(function(e) {
   	if (e.which == 13) facilityNameSearch();
  });
});
