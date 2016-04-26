{
    "NAME": "<?php echo $facility_info[0][0]['facility_name']; ?>",
    "PARENT": "<?php echo $facility_info[0][0]['owner_name']; ?>",
    "DANGER": "<?php echo $facility_info[0][0]['dangerous_state']; ?>",
    "BROWN": "<?php echo $facility_info[0][0]['is_brownfield']; ?>",
    "ADDR": "<?php echo $facility_info[0][0]['location_id']; ?>",
    "COUNTY": "<?php echo $facility_info[0][0]['county']; ?>",
    "MUN": "<?php if($facility_info[0][0]['municipality'] == null) echo "N/A"; else echo $facility_info[0][0]['municipality']; ?>",
    "LAT": "<?php 
                if ($facility_info[0][0]['latitude'] == null)
                    echo 'Latitude: N/A';
                else
                    echo 'Latitude: ' . $facility_info[0][0]['latitude']; 
                ?>,
"LNG": "<?php 
                if ($facility_info[0][0]['longitude'] == null)
                    echo 'Longitude: N/A';
                else
                    echo 'Longitude: ' . $facility_info[0][0]['longitude']; 
                ?>,
    "XY": "<?php 
                if ($facility_info[0][0]['x_coor'] == null || $facility_info[0][0]['y_coor'] == null)
                    echo 'X Coordinate: N/A, Y Coordinate: N/A';
                else
                    echo 'X Coordinate: ' . floatval($facility_info[0][0]['x_coor']) . ', ' . 'Y Coordinate: ' . -1*floatval($facility_info[0][0]['y_coor']); 
                ?>"
}