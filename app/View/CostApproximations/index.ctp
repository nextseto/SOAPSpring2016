<!doctype html>

<html>
<head>
	<style>

table, th, tr {

	text-indent:32px;
}
</style>
   
</head>

  <body>	

		<h1>Cost Estimations</h1>
		
<script type = "text/javascript">


//Worked on by Dom, Joe, Maulik, and John
//Software Engineering class spring 2015

// Define functions
  function makeArray(n){
                this.length = n
                return this
        }

        //Constructor for the site objects
        function aSite(name, address, county, size){
                this.name = name
                this.address = address
                this.county = county
                this.size = size
       
        }

	function asphaltCapping(size){

		var low = size * 5000
		var high = size * 7000
		
		low = low.toFixed(2)
		high = high.toFixed(2)
		
		var result = "$" + low + " - $" + high

		return result
	}

	function subBase(size){

		var sqYards = size * 4840
		var low = sqYards * 2.50
		var high = sqYards * 7

		low = low.toFixed(2)
                high = high.toFixed(2)
		
		var result = "$" + low + " - $" + high

                return result
	}

	function surface(size){

		var sqYards = size * 4840
                var low = sqYards * 12
                var high = sqYards * 20

                low = low.toFixed(2)
                high = high.toFixed(2)
             
                var result = "$" + low + " - $" + high

                return result
	}

sites = new makeArray(36)

//Instantiate property sites in an Array
//Due to semester length and lack of complete property information, only a limited amount of properties were processed

sites[0] = new aSite("3M CO", "225 Willowbrook Rd", "Monmouth", 23.83)
sites[1] = new aSite("3M CO ELECTRICAL PRODUCTS DIV", "1571 Imperial Way", "Gloucester", 5.19)
sites[2] = new aSite("ABLE LABORATORIES", "6 Hollywood Court", "Middlesex", 2.34)
sites[3] = new aSite("ABLON FINISHES INC", "84 Waydell St", "Essex", 1.14)
sites[4] = new aSite("ACME ENGRAVING CO INC", "19 Delaware Ave", "Passaic", 0.61)
sites[5] = new aSite("ACME GEAR CO INC", "129 Coolidge Ave", "Bergen", 0.16)
sites[6] = new aSite("ACRILEX INC", "230 Culver Ave", "Hudson", 0.461)
sites[7] = new aSite("ACTAVIS ELIZABETH LLC", "200 Elmore Ave", "Union", 6.03)
sites[8] = new aSite("ACTEGA KELSTAR INC", "1050 Taylors Ln", "Burlington", 4.69)
sites[9] = new aSite("ACTEGA RADCURE INC", "9 Audrey Pl", "Essex", 0.93)
sites[10] = new aSite("ACTEGA RADCURE INC", "5 Mansard Ct", "Passaic", 3.1)
sites[11] = new aSite("ACUPOWDER INTERNATIONAL LLC", "901 Lehigh Ave", "Union", 8.54)
sites[12] = new aSite("ADM COCOA PRODUCTS", "600 Ellis Rd", "Gloucester", 39.31)
sites[13] = new aSite("ADP GRAPHIC COMMUNICATIONS", "100 Burma Rd", "Hudson", 8)
sites[14] = new aSite("ADRON INC", "94 Fanny Rd", "Morris", 12.48)
sites[15] = new aSite("ADVANCED BIOTECH", "10 Taft Rd", "Passaic", 4.93)
sites[16] = new aSite("ADVANCED CERAMETRICS INC", "245 Main St", "Hunterdon", 0.1)
sites[17] = new aSite("ADVANCED MONOBLOC CORP", "5 Boxal", "Middlesex", 12.03)
sites[18] = new aSite("ADVANCE FIBER TECHNOLOGIES CORP", "344 Lodi St", "Bergen", 2.11)
sites[19] = new aSite("ADVANCE PROCESS SUPPLY CO", "6900 River Rd", "Camden", 1.93)
sites[20]=new aSite("AERCO INTERNATIONAL INC","159 Paris ave","Bergen",3.63)
sites[21]=new aSite("AEROPANEL CORP","661 Myrtle ave","Morris",2.31)
sites[22]=new aSite("AETNA CHEMICAL CORP","21 Wallace St","Bergen",2.6)
sites[23]=new aSite("AFFILIATED MANUFACTURERS INC","3087 RT 22","Somerset",7.05)
sites[24]=new aSite("AFP TRANSFORMERS INC","206 Talmadge Rd","Middlesex",3.48)
sites[25]=new aSite("AGC CHEMICALS AMERICAS INC","229 E 22ND ST","Hudson",2.94)
sites[26]=new aSite("AGFA CORP","195 N ST","Bergen",4.36)
sites[27]=new aSite("AGFA CORP AGFA PHOTO DIV","8 Henderson Dr","Essex",15)
sites[28]=new aSite("AGFA CORP BRANCHBURG NJ MANUFACTURING","50 Meister Ave","Somerset",39)
sites[29]=new aSite("AGILENT TECHS","140 Green Pond Rd","Morris",97.29)
sites[30]=new aSite("AGILEX FLAVORS & FRAGRANCES","130 Industrial PKWY","Somerset",3.51)
sites[31]=new aSite("AGWAY INC","50 Manheim Ave","Cumberland",2.22)
sites[32]=new aSite("AIRGAS EAST INC","5 Iron Horse Rd","Bergen",2.12)
sites[33]=new aSite("AJAX MFG CO.","321 valley Rd","Somerset",69.06)
sites[34]=new aSite("AKCROS CHEMICALS INC","500 Jersey Ave","Middlesex",9.04)
sites[35]=new aSite("AKZO NOBEL","10 Finderne Ave","Somerset",82.79)
var content = "<table><tr><th>Name</th><th>Address</th><th>County</th><th>Lot Size (acres)</th><th>Asphalt Capping:Clearing</th><th>Asphalt Capping: 1 in. sub-base</th><th>Asphalt Capping: 1.5 in. surface</th></tr>"

//Print each property in the table with corresponding data
//Print table to Soap cost page
for(i = 0; i < sites.length; i++)
{	
	content+= "<tr><td>" + sites[i].name + "</td><td>" + sites[i].address + "</td><td>" + sites[i].county +"</td><td>" + sites[i].size + "</td><td>" + (asphaltCapping(sites[i].size)) +  "</td><td>" + (subBase(sites[i].size)) + "</td><td>" + (surface(sites[i].size))  + "</td></tr>"
}	

content += "</table>"

document.write(content)

</script>		
		
      </body>
</html>
