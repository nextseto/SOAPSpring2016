<!doctype html>
<html>
    <head>
        <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>/js/userQuery.js"></script>
    </head>
    <body>
        <div class="span2">
 <div style= "position:fixed;"><?php echo $this->element('sidebar'); ?></div>
    <div style = "text-align:center; padding-top:275px;" ><?php echo " Click on the Picture for Information About Habitat for Humanity in Trenton!";?>                 
    <a href= "https://www.habitatta.org/" target="_blank"><img src="<?php echo $this->webroot; ?>img/habitat_trenton.jpg" style="width:150px; height:250px"></a>
</div>
      </div>
       <div class="span10">
 	<div style= "text-align:center;">
        <h1>Advocacy Groups</h1></div>
           <!-- <div style="text-align:center;"><input style="width:70%; padding-left:18px; background: white no-repeat scroll left center url('<?php echo $this->webroot; ?>img/icon_search.png');" id="mainSearchBar" type="text" placeholder="Search advocacy group by name or click 'options' for more advanced searching."><a title="Options" id="select_cog" href="#"><img style="position:relative; z-index:100; margin-left:-60px; margin-top:-7px;" src="<?php echo $this->webroot; ?>img/icon_cog.png"></a></div>
            <div id="options" style="display:none; color:white; margin-bottom:20px;">
                <label class="filterLabel">Filters:</label><br>
                <label class="filterLabel">Name</label><input class="filter" type="input"><br>
                <label class="filterLabel">Party</label><input class="filter" type="input"><br>
                <label class="filterLabel">Year Elected</label><input class="filter" type="input"><br>
                <label class="filterLabel">District Number</label><input class="filter" type="input"><br>
            </div>//-->
	    <div style= "text-align:center;">
	    <h3>Click on the Names Below to Learn More about these Advocacy Groups</h3></div>
            <input id="currentOffset" type="hidden">
            <input id="currentCount" type="hidden">
            <input id="currentLimit" type="hidden" value=30>
            <style>
                .thumbnails > li{
                }
                .thumbnails .caption{
                    overflow:hidden;
                    text-overflow:ellipsis;
                    white-space:nowrap;
                }
                .thumbnails img{
                    height:220px;
                    width:151px;
                }
            </style>
	    <!-- Each advocacy group has an image that represents the particular group. When the image is clicked, a new tab opens with the advovacy group's website -->
             <ul id="politicianList" class="thumbnails">
		<li>
		<div class="span3">
		<div class="thumbnail">
		<img src="<?php echo $this->webroot; ?>img/image3.jpg"> <!--This centers the Caption-->
		<div class="caption" style="text-align:center;">
		<!--This is the site the user is navigated to after they click on the image-->
		<a href= "http://www.anjee.net/" target="_blank"><h3 style="color:#F5F3DC;">Alliance for New Jersey</h3>
		<h3 style="color:#F5F3DC;"> Environmental Education</h3><!--This selects the color that the name of the group is going to be in-->
		<br></div></div></li></a>
		
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image4.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.littoralsociety.org/" target="_blank"><h3 style="color:#F5F3DC;">American Littoral<br>Society</h3>
                <br></div></div></li></a>
		
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image5.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://anjec.org/" target="_blank"><h3 style="color:#F5F3DC;">Association of New Jersey<br>Environmental Commissions</h3>
                <br></div></div></li></a>
		
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image6.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://njhazwaste.com/" target="_blank"><h3 style="color:#F5F3DC;">Association of NJ Household<br>Hazardous Waste COORD</h3>
                <br></div></div></li></a>
		
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image7.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://bbp.ocean.edu/pages/1.asp" target="_blank"><h3 style="color:#F5F3DC;">Barnegat Bay<br>Partnership</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image8.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cumauriceriver.org/" target="_blank"><h3 style="color:#F5F3DC;">Citizens<br>United</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image9.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cleanoceanaction.org/index.php?id=334" target="_blank"><h3 style="color:#F5F3DC;">Clean Ocean<br>Action</h3>
                <br></div></div></li></a>
	
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image10.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cleanwaterfund.org/" target="_blank"><h3 style="color:#F5F3DC;">Clean Water<br>Fund</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image12.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://cahenj.org/" target="_blank"><h3 style="color:#F5F3DC;">Coalition for Affordable<br> Housing &#38; the Environment</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="http://video.google.com/ThumbnailServer2?app=blogger&contentid=cefea4ad79d8da8d&offsetms=5000&itag=w160&sigh=4YKw5unYHLCvHtPul_YAkmNn_eE">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.canalwatch.org/" target="_blank"><h3 style="color:#F5F3DC;">D&#38;R Canal<br>Watch</h3>
                <br></div></div></li></a>
	
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image13.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.drgreenway.org/" target="_blank"><h3 style="color:#F5F3DC;">D&#38;R<br>Greenway</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image14.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.nj.gov/drbc/" target="_blank"><h3 style="color:#F5F3DC;">Delaware River<br>Basin Commission</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image15.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.delawareriverkeeper.org/" target="_blank"><h3 style="color:#F5F3DC;">Delaware River<br>Keeper Network</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image0.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.eohsi.rutgers.edu/" target="_blank"><h3 style="color:#F5F3DC;">Environmental &#38; Occup<br>Health Sciences Institute</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image1.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.fohvos.org/" target="_blank"><h3 style="color:#F5F3DC;">Friends of Hopewell<br>Valley Open Space</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image2.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.gsearthinstitute.org/" target="_blank"><h3 style="color:#F5F3DC;">Garden State<br>Earth Institute</h3>
                <br></div></div></li></a>

		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image17.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.njenvironment.org/" target="_blank" ><h3 style="color:#F5F3DC;">New Jersey<br>Environmental Lobby</h3>
                <br></div></div></li></a>
		
		<li>
                <div class="span3">
                <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/image18.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.mcclearwater.org/" target="_blank" ><h3 style="color:#F5F3DC;"> New Jersey Friends<br> of Clearwater</h3>
                <br></div></div></li></a>


    <!--	<div class="thumbnail"><h3><table style="width:95%; text-align:center;" align="center">
=======
	    </style>
            <ul id="politicianList" class="thumbnails">
	    <table style="width:95%; text-align:center;" align="center">
>>>>>>> a2a75d680faeba32fde256c664f54fc6b1fe10e0
	    <tr>
		<td><a href= "http://www.anjee.net/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image3.jpg" style="width:150px; height:100px"><br> Alliance for New Jersey<br> Environmental Education</td>
                <td><a href= "http://www.littoralsociety.org/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image4.jpg" style="width:150px; height:100px"><br> American Littoral Society</td>
	>
                <div class="span3">
                <div class="thumbnail">
                <img src="http://www.pisaurolaw.com/wp-content/uploads/2013/03/p_michaelpisauro.png">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.njenvironment.org/michaelpisauro.htm" target="_blank" ><h3 style="color:#F5F3DC;">Michael L. Pisauro</h3>
                <br></div></li></a>
<td><a href= "http://anjec.org/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image5.jpg" style="width:150px; height:100px"><br> Association of New Jersey<br> Environmental Comissions</td>
            </tr>
<<<<<<< HEAD
            <tr>
                <td><a href= "http://njhazwaste.com/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image6.jpg" style="width:150px; height:100px"><br>Association of New Jersey<br> Household Hazardous Waste Coordinators</td>
                <td><a href= "http://bbp.ocean.edu/pages/1.asp" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image7.jpg" style="width:150px; height:100px"><br> Barnegat Bay Partnership</td>
                <td><a href= "http://www.cumauriceriver.org/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image8.jpg" style="width:150px; height:100px"><br> Citizens United</td>
=======
 	    <tr>
                <td bgcolor="#748c73">Clean Ocean Action</td>
                <td bgcolor="#748c73">Clean Water Fund</td>
                <td bgcolor="#748c73">Coalition for Affordable Housing<br> and the Environment</td>
>>>>>>> 1565d031224d68445893761dcba5284fd393a21b
            </tr>
            <tr>
                <td> <a href= "http://www.cleanoceanaction.org/index.php?id=334" target="_blank"><img src="<?php echo $this->webroot; ?>img/image9.jpg" style="width:150px; height:100px"><br> Clean Ocean Action</td>
                <td><a href= "http://www.cleanwaterfund.org/ " target="_blank"> <img src="<?php echo $this->webroot; ?>img/image10.jpg" style="width:150px; height:100px"><br>Clean Water Fund</td>
                <td><a href= "http://cahenj.org/" target="_blank"> <img src="<?php echo $this->webroot; ?>img/image12.jpg" style="width:150px; height:100px"><br> Coalition for Affordable Housing<br> and the Environment</td>
	    </tr>
 	    <tr>
                <td bgcolor="#748c73">D&#38;R Canal Watch</td>
                <td bgcolor="#748c73">D&#38;R Greenway</td>
                <td bgcolor="#748c73">Delaware River Basin Commission</td>
            </tr>
	    <tr>
<<<<<<< HEAD
                <td bgcolor="#748c73">Delaware River Keeper Network</td>
                <td bgcolor="#748c73">""</td>
                <td bgcolor="#748c73">""</td>
            </tr>
	    <tr>
                <td bgcolor="#748c73">""</td>
                <td bgcolor="#748c73">""</td>
                <td bgcolor="#748c73">""</td>
            </tr>
	    <tr>
                <td bgcolor="#748c73">""</td>
                <td bgcolor="#748c73">""</td>
                <td bgcolor="#748c73">""</td>
=======
>>>>>>> 6b029ce1e8839fe93df9bf9b587f4bd63950b002
                <a href= "http://www.mcclearwater.org/" target="_blank"><h3 style="color:#F5F3DC;">New Jersey Friends<br>of Clearwater</h3>
                <br></div></div></li></a>
           <!--<div class="row-fluid">
	    </table></h3>
</div>-->
        </ul>

	  <!-- <div class="row-fluid">
                <div class="span2" style="margin-top:12px; text-align:center;">
                    Page <span id="currentPage">1</span> of <span id="pageCount"></span><br><span id="totalResults"></span>	
                </div>
                <div id="pageList" class="span7 pagination pagination-centered">
                </div>
                <div class="span3" style="margin-top:12px; text-align:center;">
                    Items per Page:
                    <a href="#" class="limit" style="text-decoration:underline">30</a>
                </div>
                <script>
                   bindEventsPoliticians("senators", "district_no");
                </script> -->
            </div> <!-- row-fluid -->
            <!-- <?php echo $this->Facebook->comments(); ?> -->
        </div>
	<?php $this->Js->writeBuffer(); ?>
    </body>
</html>

