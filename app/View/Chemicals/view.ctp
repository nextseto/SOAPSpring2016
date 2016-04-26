
{
    "NAME": "<?php echo addslashes($chem_info[0][0]['chemical_name']); ?>",
    "CAR": "<?php echo $chem_info[0][0]['carcinogenic']; ?>",
    "CLEANAIR": "<?php echo $chem_info[0][0]['clean_air_act']; ?>",
    "METAL": "<?php echo $chem_info[0][0]['metal']; ?>",
    "PBT": "<?php echo $chem_info[0][0]['pbt']; ?>",
    "FACILITY": [
        <?php for ($x = 0; $x < count($facility_info); $x++) 
        {
            echo '{ "name" : "' . addslashes($facility_info[$x][0]["facility_name"]) . '", "id" : "' . $facility_info[$x][0]["facility_id"] . '" }';
                        
            echo ($x < count($facility_info) - 1 ? ',' : '');
        }
        ?>
    ]
}