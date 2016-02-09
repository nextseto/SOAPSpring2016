psql -h 127.0.0.1 -w -p 5432 -U postgres -d soap

\COPY (SELECT facilities.id, facilities.facility_name, locations.x_coor, locations.y_coor 
		FROM newsoap.facilities INNER JOIN newsoap.locations ON facilities.location_id=locations.id 
		ORDER BY facilities.id) TO '/var/www/html/facilities.csv' CSV DELIMITER '\t';

\COPY (SELECT contains.facility_id, contains.chemical_id, chemicals.chemical_name, contains.total_amount
		FROM newsoap.contains INNER JOIN newsoap.chemicals ON chemicals.id=contains.chemical_id 
		ORDER BY facility_id) TO '/var/www/html/contains.csv' CSV DELIMITER '\t';
