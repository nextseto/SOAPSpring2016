<!doctype html>
<html>
<head>     
   <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" src="/cabect/SOAP/app/webroot/js/userQuery.js"></script>
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
        <h1>Advocacy Groups</h1>
 <h3>Click on the Names Below to Learn More about these Advocacy Groups</h3>
</div>
<!-- styles the flex box items and container --> 
<style>
.flex-container {
  padding: 0;
  margin: 0;
  align-items:center;
  list-style: none;
  display: -webkit-box;
  display: -moz-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  flex-wrap:wrap; 
  -webkit-flex-flow: row wrap;
  justify-content: space-around;
}
.flex-item {
  background: #617561;
  padding: 5px;
  width: 250px;
  height: 350px;
  margin-top: 10px;
  line-height: 150px;
  box-shadow:0 1px 1px rgba(0, 0, 0, 0.075);
  color: white;
  border-radius:4px;
  font-weight: bold;
  font-size: 3em;
  align-items:center;
  text-align: center;
}

</style> 
<!-- Flex contianer -->
<ul class="flex-container">
<!-- flex items --> 
  <li class="flex-item">
		<img src="<?php echo $this->webroot; ?>img/image3.jpg">
 <!--This centers the Caption-->
		<div class="caption" style="text-align:center;">
		<!--This is the site the user is navigated to after they click on the image-->
		<a href= "http://www.anjee.net/" target="_blank"><h3 style="color:#F5F3DC;">Alliance for New Jersey</h3>
		<h3 style="color:#F5F3DC;"> Environmental Education</h3>
<!--This selects the color that the name of the group is going to be in-->
		<br>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image4.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.littoralsociety.org/" target="_blank"><h3 style="color:#F5F3DC;">American Littoral<br>Society</h3>
</a>
	</li>
  <li class="flex-item">
	                <img src="<?php echo $this->webroot; ?>img/image5.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://anjec.org/" target="_blank"><h3 style="color:#F5F3DC;">Association of New Jersey<br>Environmental Commissions</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image6.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://njhazwaste.com/" target="_blank"><h3 style="color:#F5F3DC;">Association of NJ Household<br>Hazardous Waste COORD</h3>
</a>
		</li>
  <li class="flex-item">	
                <img src="<?php echo $this->webroot; ?>img/image7.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://bbp.ocean.edu/pages/1.asp" target="_blank"><h3 style="color:#F5F3DC;">Barnegat Bay<br>Partnership</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image8.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cumauriceriver.org/" target="_blank"><h3 style="color:#F5F3DC;">Citizens<br>United</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image9.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cleanoceanaction.org/index.php?id=334" target="_blank"><h3 style="color:#F5F3DC;">Clean Ocean<br>Action</h3>
</a>	
</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image10.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.cleanwaterfund.org/" target="_blank"><h3 style="color:#F5F3DC;">Clean Water<br>Fund</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image12.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://cahenj.org/" target="_blank"><h3 style="color:#F5F3DC;">Coalition for Affordable<br> Housing &#38; the Environment</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="http://video.google.com/ThumbnailServer2?app=blogger&contentid=cefea4ad79d8da8d&offsetms=5000&itag=w160&sigh=4YKw5unYHLCvHtPul_YAkmNn_eE">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.canalwatch.org/" target="_blank"><h3 style="color:#F5F3DC;">D&#38;R Canal<br>Watch</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image13.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.drgreenway.org/" target="_blank"><h3 style="color:#F5F3DC;">D&#38;R<br>Greenway</h3>
</a>
	</li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image14.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.nj.gov/drbc/" target="_blank"><h3 style="color:#F5F3DC;">Delaware River<br>Basin Commission</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image15.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.delawareriverkeeper.org/" target="_blank"><h3 style="color:#F5F3DC;">Delaware River<br>Keeper Network</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image0.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.eohsi.rutgers.edu/" target="_blank"><h3 style="color:#F5F3DC;">Environmental &#38; Occup<br>Health Sciences Institute</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image1.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.fohvos.org/" target="_blank"><h3 style="color:#F5F3DC;">Friends of Hopewell<br>Valley Open Space</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image2.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.gsearthinstitute.org/" target="_blank"><h3 style="color:#F5F3DC;">Garden State<br>Earth Institute</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image17.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.njenvironment.org/" target="_blank" ><h3 style="color:#F5F3DC;">New Jersey<br>Environmental Lobby</h3>
</a>
        </li>
  <li class="flex-item">
                <img src="<?php echo $this->webroot; ?>img/image18.jpg">
                <div class="caption" style="text-align:center;">
                <a href= "http://www.mcclearwater.org/" target="_blank" ><h3 style="color:#F5F3DC;"> New Jersey Friends<br> of Clearwater</h3>
</a>
        </li>

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
