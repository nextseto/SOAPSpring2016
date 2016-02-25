<!doctype html> 
<html> 
<head> 
        <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" "<?php echo $this->webroot; ?>/js/userQuery.js"></script>
    </head>
    <body>
<div class ="span2">
            <?php echo $this->element('sidebar'); ?>
        </div>
        <div class="span10" style="text-align:center;">
            <style>
                .pol_link{
                   width:300px;
                   height:120px;
                   border: 3px ridge white;
                   margin:30px;
                }
            </style>
            <h2>Explore the NJ State Legislature and Lobbyists:</h2>
	        <?php echo $this->Html->image("senate_link.jpg", array( 'class'=>'pol_link',  "alt" =>  "Image Not available", 'url' => array('controller' => 'Senators'))); ?>
		<?php echo $this->Html->image("rep_link.jpg", array( 'class'=>'pol_link',  "alt" =>  "Image Not available", 'url' => array('controller' => 'Representatives'))); ?>
		<?php echo $this->Html->image("lob_link.jpg", array( 'class'=>'pol_link',  "alt" =>  "Image Not available", 'url' => array('controller' => 'Advocacygroups'))); ?>

</div>
    </body>
</html>
