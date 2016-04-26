<!-- File: /app/View/Facilities/view.ctp -->



<div class=span2>
    <?php echo $this->element('sidebar'); ?>
</div>
<div class="span9" style="margin-left:20%">
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
    
    body {
        color: #333;
        padding: 1.5em;
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

<button data-js="openPopup">Facility Popup</button>

<div class="popup">
    <div style="float:left; width: 85%;">
        <button name="closePopup" style="float:right">Close</button>
        <button style="float:right" onclick="switchDisplay(1)">Chemicals</button>
        <button style="float:right" onclick="switchDisplay(0)">Location</button>
        <h2><?php echo $facility_info[0][0]['facility_name']; ?></h2>
        <hr>
        <br>
        <div id="build-info">
            <div style="float:left; width: 49%;">
                <h3>Parent Company:
                    <?php echo $facility_info[0][0]['owner_name']; ?>
                </h3>
                <h3>Danger Level:
                    <?php echo $facility_info[0][0]['dangerous_state']; ?>/5
                </h3>
                <h3>Brownfield:
                    <?php echo $facility_info[0][0]['is_brownfield']; ?>
                </h3>
                <br>
                <h3>Street Address:
                    <?php echo $facility_info[0][0]['location_id']; ?>
                </h3>
                <h3>County:
                    <?php echo $facility_info[0][0]['county']; ?>
                </h3>
                <h3>Municipality:
                    <?php if($facility_info[0][0]['municipality'] == null) echo "N/A"; else echo $facility_info[0][0]['municipality']; ?>
                </h3>
                <h3>
                    <?php 
                if ($facility_info[0][0]['latitude'] == null || $facility_info[0][0]['longitude'] == null)
                    echo 'Latitude: N/A, Longitude: N/A';
                else
                    echo 'Latitude: ' . $facility_info[0][0]['latitude'] . ', ' . 'Longitude: ' . $facility_info[0][0]['longitude']; 
                ?>
                </h3>
                <h3>
                <?php 
                if ($facility_info[0][0]['x_coor'] == null || $facility_info[0][0]['y_coor'] == null)
                    echo 'X Coordinate: N/A, Y Coordinate: N/A';
                else
                    echo 'X Coordinate: ' . floatval($facility_info[0][0]['x_coor']) . ', ' . 'Y Coordinate: ' . -1*floatval($facility_info[0][0]['y_coor']); 
                ?>
                </h3>
            </div>
            <div style="float:right; width: 49%;">
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

            </div>
        </div>
        <div id="build-chem" style="display:none;">

            <div style="float:left">
                <?php foreach ($chem_info as $chem): ?>
                    <h3><a class="pageLink" href='/../SOAP/index.php/chemicals/view/<?php echo $chem[0]['chemical_id']; ?>'><?php echo $chem[0]['chemical_name']; ?></a></h3>
                    <h4>Total Amount: <?php echo $chem[0]['total_amount']; ?></h4>
                    <h4>Fugitive Air Amount: <?php echo $chem[0]['fugair_amount']; ?></h4>
                    <h4>Water Amount: <?php echo $chem[0]['water_amount']; ?></h4>
                    <h4>Stack Air Amount: <?php echo $chem[0]['stackair_amount']; ?></h4>
                    <br>
                    <?php endforeach; ?>
            </div>
            <div style="float:right">
                <img src="http://downloadicons.net/sites/default/files/piechart-icon-3260.png">
            </div>

        </div>
    </div>
</div>

<script>
    function popupOpenClose(e) {
        0 == $(".wrapper").length && $(e).wrapInner("<div class='wrapper'></div>"), $(e).show(), $(e).click(function (n) {
            n.target == this && $(e).is(":visible") && $(e).hide()
        }), $(e).find("button[name=closePopup]").on("click", function () {
            $(".formElementError").is(":visible") && $(".formElementError").remove(), $(e).hide()
        })
    }
    $(document).ready(function () {
        $("[data-js=openPopup]").on("click", function () {
            popupOpenClose($(".popup"))
            switchDisplay(0)
        })
    });

    function switchDisplay(eID) {
        var id = ['build-info', 'build-chem']
        if (document.getElementById(id[eID]).style.display == 'none') {
            document.getElementById(id[eID]).style.display = 'block'
            document.getElementById(id[Math.abs(eID - 1)]).style.display = 'none'
        }
    }
</script>


    <!-- Something social -->