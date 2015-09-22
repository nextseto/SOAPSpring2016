<!doctype html>
<html>
    <head>
        <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" src="/cabect/SOAP/app/webroot/js/userQuery.js"></script>
    </head>
    <body>
        <div class="span2">
            <?php echo $this->element('sidebar'); ?>
        </div>
        <div class="span10" style="text-align:center; margin-left:25%;">
            <style>
                .pol_link{
                   width:300px;
                   height:120px;
                   border: 3px ridge white;
                   margin:30px;
                }

            </style>
            <h2>Explore the NJ State Legislature and Advocacy Groups:</h2>
            <a href="/SOAP/index.php/senators"><img class="pol_link" src="<?php echo $this->webroot; ?>/img/senate_link.jpg"></a> 
		<!--This is where the user can click the Senator link/image to view the Senators, the year they were elected, their political party, and the disrtic number they represent.-->  
            <a href="/SOAP/index.php/representatives"><img class="pol_link" src="<?php echo $this->webroot; ?>/img/rep_link.jpg"></a><br>
		<!--//This is where the user can click the Assembly link/image to view the Assembly, the year they were elected, their political party, and the disrtic number they represent.-->
	    <a href="/SOAP/index.php/advocacygroups"><img class="pol_link" src="<?php echo $this->webroot; ?>/img/lob_link.jpg"></a>
		<!--This is where the user can click the Advocacy Groups link/image to view the Advocacy Groups.-->

        </div>
    </body>
</html>
