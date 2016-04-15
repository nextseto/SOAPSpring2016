<!-- File: /app/View/Chemicals/view.ctp Test change is up here -->

<!-- Andrew Preuss 11/9, Chemical List does not show up well on mobile, can narrow the size of the table so that smaller screens do not mess up the table formatting. -->
<!-- Andrew Preuss 11/9, changinging the font size would also be an easy fix to solve the problem of table formatting on smaller screens. -->
<div class=span2>
     <?php echo $this->element('sidebar'); ?> 
</div>
<div class="span9" style="margin-left:20%">
    <style>
        .details{
            margin-bottom:25px;
        }
        hr{
            border-color:#013435;
            margin:5px;
        }
        h1{
            font-size:12px;
        }
        h2{
            font-size:12px;
        }
        h3{
            font-size:12px;
        }
        h4{
            font-size:12px;
        }
        a.pageLink{
            color:#037162;
        }
    </style>
    <!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="google" value="notranslate">
    <title>Facilities Popup (location)</title>
    <style>
        .popup {
            background: rgba(255, 255, 255, 0.8);
            position: fixed;
            display: none;
            z-index: 5000;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
        }
        
        .popup > div {
            border-radius: 4px;
            position: fixed;
            background: #FFFFFF;
            box-shadow: 0px 0px 12px #666666;
            padding: 1em 2em 2em;
            width: 80%;
            max-width: 600px;
            z-index: 5001;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
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
</head>

<body>

    <button data-js="openPopup">Open Pop-up</button>

    <div class="popup">
      
        <button name="closePopup" style="float:right">Close</button>
        <button style="float:right">Chemicals</button>
        <button style="float:right">Location</button>
        <h2>3M CO</h2>
        <hr>
        <br>
        <div style="float:left">
            <p>Parent Company: 3M CO INC</p>
            <p>Danger Level: 1 (out of 5)</p>
            <p>Brownfield: N/A</p>
            <br>
            <p>Street Address: 225 WILLOWBROOK RD</p>
            <p>County: MONMOUTH</p>
            <p>Municipality: N/A</p>
            <p>Latitude: 01°44'41", Longitude: 11°51'18"</p>
            <p>X Coordinate: 40.2408, Y Coordinate: -74.269</p>
        </div>

        <div style="float:right">
            <div id="map"></div>
            <script>
                function initMap() {
                    var myLatLng = {
                        lat: 40.2408,
                        lng: -74.269
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 14,
                        center: myLatLng,
                        disableDefaultUI: true
                    });

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: '3M CO'
                    });
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
        </div>
        


       
    </div>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

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
            })
        });
    </script>
</body>

</html>
    <!--<h1 style="text-align:center;"><?php echo $chem_info[0][0]['chemical_name']; ?></h1>
    <div class="details">
        <h1>Chemical Details:</h1>
        <hr />
        <h3>Carcinogenic: <?php echo $chem_info[0][0]['carcinogenic']; ?></h3>
        <h3>Clean Air Act: <?php echo $chem_info[0][0]['clean_air_act']; ?></h3>
        <h3>Metal: <?php echo $chem_info[0][0]['metal']; ?></h3>
        <h3>PBT: <?php echo $chem_info[0][0]['pbt']; ?></h3>
    <h3>Effects:</h3>
    </div>
    <div class="details">
        <h1>Facilities that contain this chemical:</h1>
        <hr />
        <?php foreach ($facility_info as $facility): ?>
            <h3><a class="pageLink" href='/../SOAP/index.php/facilities/view/<?php echo $facility[0]['facility_id']; ?>'><?php echo $facility[0]['facility_name']; ?></a></h3>
        <?php endforeach; ?>
    </div>
    <br>
    <br>
    <!--
    <!--<?php echo $this->Facebook->share(); ?>
    <br>
    <br>
    <a href="https://twitter.com/share" class="twitter-share-button" data-text="TCNJ SOAP" data-via="TCNJSoap" data-size="large">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> -->
    <!-- AddThis Button BEGIN -->
    <!--
    <div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
    <a class="addthis_counter addthis_pill_style"></a>
    </div>
    <!--
    <!-- <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script> -->
    <!--
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fe8fc260b784686"></script>

    <!-- AddThis Button END -->
        <br>
        <h5>Comments: </h5>
    <!--    <div id="disqus_thread"><!--</div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'tcnjsoap'; // required: replace example with your forum shortname
        
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
    -->
   <!-- <style>
        .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget iframe[style]{
            width:600px !important;
        }
    </style>
    <div class="facebook" width="100%">
    <?php echo $this->Facebook->comments(
            $options = array(
                //'width' => '300%',
                'mobile' => 'false'
                )
            );  ?>
            -->
    </div>
</div>
