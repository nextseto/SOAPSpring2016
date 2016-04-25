<!-- File: /app/View/Chemicals/view.ctp Test change is up here -->

<!-- Andrew Preuss 11/9, Chemical List does not show up well on mobile, can narrow the size of the table so that smaller screens do not mess up the table formatting. -->
<!-- Andrew Preuss 11/9, changinging the font size would also be an easy fix to solve the problem of table formatting on smaller screens. -->
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
`	      overflow-y: scroll;
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
            width: 300px;
            height: 200px;
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

    <button data-js="openPopup">Chemical Popup</button>

    <div class="popup">
        <div style="float:left;">
            <button name="closePopup" style="float:right">Close</button>
            <button style="float:right" onclick="switchDisplay(1)">Location</button>
            <button style="float:right" onclick="switchDisplay(0)">Statistics</button>
            <h2><?php echo $chem_info[0][0]['chemical_name']; ?></h2>
            <hr>
            <br>
            <div id="chem-info">
                <h3>Carcinogenic:
                    <?php echo $chem_info[0][0]['carcinogenic']; ?>
                </h3>
                <h3>Clean Air Act:
                    <?php echo $chem_info[0][0]['clean_air_act']; ?>
                </h3>
                <h3>Metal:
                    <?php echo $chem_info[0][0]['metal']; ?>
                </h3>
                <h3>PBT:
                    <?php echo $chem_info[0][0]['pbt']; ?>
                </h3>
            </div>
            <div id="chem-map" style="display:none;">
                <div style="float:left; max-width: 49%;">
                    <table>
                        <thead>
                            <tr>
                                <th>Facilities that contain this chemical:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facility_info as $facility): ?>
                                <tr>
                                    <td>
                                        <a class="pageLink" href='/../SOAP/index.php/facilities/view/<?php echo $facility[0]['facility_id']; ?>'>
                                            <?php echo $facility[0]['facility_name']; ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div style="float:right; max-width: 49%;">
                    <div id="map"></div>
                    <script>
                        function initMap() {
                            var myLatLng = {
                                lat: 40.886546,
                                lng: -73.987269
                            };

                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 14,
                                center: myLatLng,
                                disableDefaultUI: true
                            });

                            var marker = new google.maps.Marker({
                                position: myLatLng,
                                map: map,
                                title: 'ACME GEAR CO INC'
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
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
            var id = ['chem-info', 'chem-map']
            if (document.getElementById(id[eID]).style.display == 'none') {
                document.getElementById(id[eID]).style.display = 'block'
                document.getElementById(id[Math.abs(eID - 1)]).style.display = 'none'
            }
        }
    </script>

    <!-- Something social -->
