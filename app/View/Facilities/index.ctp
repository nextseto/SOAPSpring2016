<!doctype html>
<html>

<head>
    <?php $this->Html->script('jquery'); ?>
        <script src="<?php echo $this->webroot; ?>/js/userQuery.js"></script>
        <style>
            .details {
                margin-bottom: 25px;
            }
            
            hr {
                border-color: #013435;
                margin: 5px;
            }
            
            h1 {
                font-size: 25px;
            }
            
            h2 {
                font-size: 20px;
            }
            
            h3 {
                font-size: 15px;
            }
            
            h4 {
                font-size: 12px;
            }
            
            a.pageLink {
                color: #037162;
            }
            
            .popup {
                background: rgba(255, 255, 255, 0.8);
                position: fixed;
                display: none;
                z-index: 5000;
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
                overflow-y: scroll;
            }
            
            .popup > div {
                border-radius: 4px;
                position: fixed;
                background: #FFFFFF;
                box-shadow: 0px 0px 12px #666666;
                padding: 1em 2em 2em;
                width: 80%;
                max-width: 768px;
                z-index: 5001;
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                -o-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                left: 50%;
                top: 50%;
                overflow-y: scroll;
                max-height: 70%;
            }
            
            #map {
                width: 100%;
                height: 250px;
                background-color: #CCC;
            }
            
            table {
                border-collapse: collapse;
                width: 100%;
            }
            
            th {
                background-color: #eee;
                font-weight: bold;
            }
            
            th,
            td {
                border: 0.125em solid #333;
                line-height: 1.5;
                padding: 0.75em;
                text-align: left;
            }
            /* Stack rows vertically on small screens */
            
            @media (max-width: 30em) {
                /* Hide column labels */
                thead tr {
                    position: absolute;
                    top: -9999em;
                    left: -9999em;
                }
                tr {
                    border: 0.125em solid #333;
                    border-bottom: 0;
                }
                /* Leave a space between table rows */
                tr + tr {
                    margin-top: 1.5em;
                }
                /* Get table cells to act like rows */
                tr,
                td {
                    display: block;
                }
                td {
                    border: none;
                    border-bottom: 0.125em solid #333;
                    /* Leave a space for data labels */
                    padding-left: 50%;
                }
                /* Add data labels */
                td:before {
                    content: attr(data-label);
                    display: inline-block;
                    font-weight: bold;
                    line-height: 1.5;
                    margin-left: -100%;
                    width: 100%;
                }
            }
            /* Stack labels vertically on smaller screens */
            
            @media (max-width: 20em) {
                td {
                    padding-left: 0.75em;
                }
                td:before {
                    display: block;
                    margin-bottom: 0.75em;
                    margin-left: 0;
                }
            }
        </style>
</head>

<body>
    <div class="span9" />
    <div class="span2">
        <?php echo $this->element('sidebar'); ?>
    </div>
    <div class="span10">
        <div style="text-align:center;margin-left:20%;">
            <br>
            <h1 style="font-size: 40px;">Facilities</h1>
            <h3>You can search any facility name to find the facility. The facility will list the its address, the county it's in, its parent company, its danger level, and if it's a brownfield. Clicking on any facility show details on its location, the chemicals found at that site and their amounts, and a Google maps view of its location.</h3>
            <br>
        </div>

        <div class="span10" style="margin-left:20%;">
            <div class="input-group">
                <div class="input-group-addon">Search</div>
                <input type="text" class="form-control" id="mainSearchBar" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <a title="Options" id="select_cog" href="#"><img style="position:relative; z-index:100; margin: 8px 0 0 -65px;" src="<?php echo $this->webroot; ?>img/icon_cog.png"></a>
            </div>

            <div id="options" style="display:none; color:white; margin-bottom:20px;">
                <label class="filterLabel">Filters:</label>
                <br>
                <label class="filterLabel">Facility Name</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Address</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">County</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Parent Company</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Danger Level</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Brownfield</label>
                <input class="filter" type="input">
                <br>
            </div>

            <table class="table table-striped" style="border-top: 0px;">
                <thead>
                    <tr>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="facility_name" class="orderButton" style="color: #f5f3dc" title="The name of the factory, production site, or environmental waste cleaning facility that typically handles or handled dangerous chemicals.">Facility Name</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="location_id" class="orderButton" style="color: #f5f3dc" title="The current or former New Jersey address of a specific factory, production site, or environmental waste cleaning facility.">Address</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="county" class="orderButton" style="color: #f5f3dc" title="A political and administrative division of a state, providing certain local governmental services. New Jersey has 21 counties.">County</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="owner_name" class="orderButton" style="color: #f5f3dc" title="Parent companies will typically be larger firms that exhibit control over one or more small subsidiaries in either the same industry or other industries.">Parent Company</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="dangerous_state" class="orderButton" style="color: #f5f3dc" title="How are we measuring the danger level?">Danger Level</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="is_brownfield" class="orderButton" style="color: #f5f3dc" title="Real property, the expansion, redevelopment, or reuse of which may be complicated by the presence or potential presence of a hazardous substance, pollutant, or contaminant.">Brownfield</a></th>
                    </tr>
                </thead>
                <input id="currentOffset" type="hidden">
                <input id="currentCount" type="hidden">
                <input id="currentOrder" type="hidden">
                <input id="currentLimit" type="hidden" value=25>
                <tbody id="dataTable">
                </tbody>
            </table>
            <div class="row-fluid">
                <div class="span2" style="margin-top:12px; text-align:center;">
                    Page <span id="currentPage">1</span> of <span id="pageCount"></span>
                    <br><span id="totalResults"></span>
                </div>
                <div id="pageList" class="span7 pagination pagination-centered">
                </div>
                <div class="span3" style="margin-top:12px; text-align:center;">
                    Items per Page:
                    <a href="#" class="limit" style="text-decoration:underline">25</a>
                    <a href="#" class="limit">50</a>
                    <a href="#" class="limit">75</a>
                    <a href="#" class="limit">100</a>
                </div>
                <script>
                    bindEvents("facilities", "facility_name");
                </script>
            </div>
            <!-- row-fluid -->
        </div>
    </div>
    <?php $this->Js->writeBuffer(); ?>
        <div class="popup">
            <div style="float:left; width: 85%;">
                <button name="closePopup" style="float:right">Close</button>
                <button style="float:right" onclick="switchDisplay(1)">Chemicals</button>
                <button style="float:right" onclick="switchDisplay(0)">Location</button>
                <h2 id="facName">Unknown Location</h2>
                <hr>
                <br>
                <div id="build-info">
                    <div style="float:left; width: 49%;">
                        <h3 id="facParent">Parent Company: Unknown</h3>
                        <h3 id="facDanger">Danger Level: Unknown</h3>
                        <h3 id="facBrown">Brownfield: Unknown</h3>
                        <br>
                        <h3 id="facAddr">Street Address: Unknown</h3>
                        <h3 id="facCou">County: Unknown</h3>
                        <h3 id="facMun">Municipality: Unknown</h3>
                        <h3 id="facLATLNG">Lat/Lng: Unknown</h3>
                        <h3 id="facXY">XY: Unknown</h3>
                    </div>
                    <div style="float:right; width: 49%;">
                        <!--
                    <div id="map"></div>
                    <script>
                        function initMap() {
                            var myLatLng = {
                            lat: <?php echo floatval($facility_info[0][0]['x_coor']) ?>,
                            lng: <?php echo -1*floatval($facility_info[0][0]['y_coor']) ?>
                        };
                            var Options = {
                                zoom: 10,
                                center: myLatLng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }
                            var map = new google.maps.Map(document.getElementById('map'), Options);
                            var marker = new google.maps.Marker({
                                position: myLatLng,
                                map: map,
                                title: "Facilities Map"
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
-->
                    </div>
                </div>
                <div id="build-chem" style="display:none;">

                    <div style="float:left" id="chemicalList">
                    </div>
                    <div style="float:right">
                        <div class="section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">

                                        <form action="#" method="#">
                                            <right>

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

                                                                <br>
                                            </right>

                                        </form>

                                        <div class="section">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <right>
                                                            <div class="col-md-12" style="float: right; width: 95%; margin-right: 1%; margin-bottom: 0.5em;"></div>
                                                            <div class="col-rt-12" style="float: right; width: 60%; margin-right: 1%; margin-bottom: 0.5em;">
                                                                <!--chemical(facility) pie chart-->
                                                                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                                                                <script type="text/javascript">
                                                                    var chemArray = <?php echo json_encode($chemInfo);?>;
                                                                    google.load("visualization", "1", {
                                                                        packages: ["corechart"]
                                                                    });
                                                                    google.setOnLoadCallback(drawChart);

                                                                    function drawChart() {
                                                                        var data = google.visualization.arrayToDataTable(chemArray);
                                                                        var options = {
                                                                            title: 'Chemicals Present in Facility',
                                                                            pieHole: 0.4,
                                                                            legend: {
                                                                                position: 'center'
                                                                            },
                                                                            backgroundColor: 'transparent',
                                                                            pieSliceTextStyle: {
                                                                                color: 'black',
                                                                            }
                                                                        };
                                                                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                                                        chart.draw(data, options);
                                                                    }
                                                                </script>

                                                                <div class="col-md-12" style="float: right; width: 95%; margin-right: 1%; margin-bottom: 0.5em;"></div>
                                                                <div class="col-rt-12" style="float: right; width: 60%; margin-right: 1%; margin-bottom: 0.5em;">
                                                                    <!--carcinogenic chemical(facility) pie chart-->
                                                                    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                                                                    <script type="text/javascript">
                                                                        var carcinogenArray = <?php echo json_encode($carcinogenicInfo);?>;
                                                                        google.load("visualization", "1", {
                                                                            packages: ["corechart"]
                                                                        });
                                                                        google.setOnLoadCallback(drawChart);

                                                                        function drawChart() {
                                                                            var data = google.visualization.arrayToDataTable(carcinogenArray);
                                                                            var options = {
                                                                                title: 'Carcinogenic Chemicals Present in Facility',
                                                                                pieHole: 0.4,
                                                                                legend: {
                                                                                    position: 'center'
                                                                                },
                                                                                backgroundColor: 'transparent',
                                                                                pieSliceTextStyle: {
                                                                                    color: 'black',
                                                                                }
                                                                            };
                                                                            var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
                                                                            chart.draw(data, options);
                                                                        }
                                                                    </script>

                                                                    <div id="donutchart" style="width: 128; height: 128;"></div>
                                                                </div>
                                                                <div class="col-rt-12" style="float: left; width: 95%; margin-right: 1%; margin-bottom: 0.5em;">
                                                                </div>
                                                            </div>
                                                        </right>
                                                        <right>
                                                            <div id="donutchart" style="width: 125%; height: 100%;"></div>
                                                            <div id="donutchart2" style="width: 125%; height: 100%;"></div>
                                                        </right>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>

<!-- Including necessary javascript for bootstrap tooltip - Joie Murphy -->
<script src='<?=$this->webroot?>js/bootstrap-alert.js' async></script>
<script src='<?=$this->webroot?>js/bootstrap-modal.js' async></script>
<script src='<?=$this->webroot?>js/bootstrap-transition.js' async></script>
<script src='<?=$this->webroot?>js/bootstrap-tooltip.js' async></script>

<script>
    function popupOpenClose(e) {
        0 == $(".wrapper").length && $(e).wrapInner("<div class='wrapper'></div>"), $(e).show(), $(e).click(function (n) {
                n.target == this && $(e).is(":visible") && $(e).hide()
            }),
            $(e).find("button[name=closePopup]").on("click", function () {
                history.pushState('', document.title, window.location.pathname);
                $(".formElementError").is(":visible") && $(".formElementError").remove(), $(e).hide()
            })
    }

    function populatePopup() {
        if (!location.hash) {
            return
        }

        popupOpenClose($(".popup"))
        switchDisplay(0)

        $.ajax({
            url: "/cabect/SOAP/index.php/facilities/view/" + location.hash.split("#")[1],
            type: 'POST',
            success: function (data) {
                
                // This data variable has ALL THE DATA TO POPULATE THE POPUP.
                data = JSON.parse(data)
                
                //Recommendation: console.log(data) if you want to take a look at the data

                document.getElementById('facName').innerHTML = data.NAME;
                document.getElementById('facParent').innerHTML = "Parent Company: " + data.PARENT;
                document.getElementById('facDanger').innerHTML = "Danger Level: " + data.DANGER + "/5";
                document.getElementById('facBrown').innerHTML = "Brownfield: " + data.BROWN;
                document.getElementById('facAddr').innerHTML = "Street Address: " + data.ADDR;
                document.getElementById('facCou').innerHTML = "County: " + data.COUNTY;
                document.getElementById('facMun').innerHTML = "Municipality: " + data.MUN;
                document.getElementById('facLATLNG').innerHTML = data.LAT + " | " + data.LNG;
                document.getElementById('facXY').innerHTML = data.XY;
                
                
                //popup's list of chemicals
                var temp = ""
                for (var count = 0, size = data.CHEMICAL.length; count < size; count++) {
                    temp += '<h3><a class="pageLink" href="/cabect/SOAP/index.php/chemicals#' + data.CHEMICAL[count].id + '">' + data.CHEMICAL[count].name + '</a></h3>'
                    temp += '<h4>Total Amount: ' + data.CHEMICAL[count].totalAmt + '</h4>'
                    temp += '<h4>Fugitive Air Amount: ' + data.CHEMICAL[count].fugAmt + '</h4>'
                    temp += '<h4>Water Amount: ' + data.CHEMICAL[count].waterAmt + '</h4>'
                    temp += '<h4>Stack Air Amount: ' + data.CHEMICAL[count].airAmt + '</h4><br>'
                }

                document.getElementById('chemicalList').innerHTML = temp;
            }
        });
    }

    $(window).on('hashchange', populatePopup);

    function switchDisplay(eID) {
        var id = ['build-info', 'build-chem']
        if (document.getElementById(id[eID]).style.display == 'none') {
            document.getElementById(id[eID]).style.display = 'block'
            document.getElementById(id[Math.abs(eID - 1)]).style.display = 'none'
        }
    }

    window.onload = function () {
        if (location.hash != '') {
            populatePopup()
        }
    };
</script>