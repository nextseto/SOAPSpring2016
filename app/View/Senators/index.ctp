<!doctype html>
<html>
    <head>
        <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>/js/userQuery.js"></script>
    </head>
    <body>

        <div class="span2">          
 <div style= "position:fixed;"><?php echo $this->element('sidebar'); ?></div>
    <div style = "text-align:center; padding-top:275px;" ><?php echo " Click on the Map for Information About Your District!";?>                  
    <!--This is a link to a map of New Jersey with the ditrict numbers; when the user clicks on a district number, it was navigate them to the New Jersey Legistlature site for their district.-->
    <a href= "http://www.njleg.state.nj.us/districts/njmap210.html" target="_blank"><img src="<?php echo $this->webroot; ?>img/StatewideOverview_Legal.jpg" style="width:150px; height:250px"></a> 
</div>    </div>  
        <div class="span9">
<!--This is resposible for the header at the top of the page -->     
            <div class="span10">
                    <div style ="text-align:center">
<!--This is the big header  -->
                        <h1>Welcome to SOAP's Senators Page</h1>
<!-- This is the sub text that describs the page function -->
                        <h3 class="text-center">
You can search any New Jersey Senators name to find that Senator. Each Senator has a picture, their name, the year they were elected, their political affiliation, and district number. 
</h3><br>
                    </div>
        </div> 
      <!--This includes the search bar if the user is looking for a particular Senator. It also has an "options" choice if the user would like to make a more advanced search.-->
            <div style="text-align:center;"><input style="width:70%; padding-left:18px; background: white no-repeat scroll left center url('<?php echo $this->webroot; ?>img/icon_search.png');" id="mainSearchBar" type="text" placeholder="Search by senator's name or click 'options' for more advanced searching."><a title="Options" id="select_cog" href="#"><img style="position:relative; z-index:100; margin-left:-60px; margin-top:-7px;" src="<?php echo $this->webroot; ?>img/icon_cog.png"></a></div>
            <div id="options" style="display:none; color:white; margin-bottom:20px;">
        <!--These are the filters in which the user can make an advanced search by typing the name, party, year elected, or district name of the Senate member they are looking for.-->
        <label class="filterLabel">Filters:</label><br>
                <label class="filterLabel"><a href="http://www.google.com">Name</a></label><input class="filter" type="input"><br>
                <label class="filterLabel">Party</label><input class="filter" type="input"><br>
                <label class="filterLabel">Year Elected</label><input class="filter" type="input"><br>
                <label class="filterLabel">District Number</label><input class="filter" type="input"><br>
            </div>
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
            <ul id="politicianList" class="thumbnails">
            </ul>
            <div class="row-fluid">
                <div class="span2" style="margin-top:12px; text-align:center;">
                    Page <span id="currentPage">1</span> of <span id="pageCount"></span><br><span id="totalResults"></span> 
                </div>
                <div id="pageList" class="span7 pagination pagination-centered">
                </div>
                <div class="span3" style="margin-top:12px; text-align:center;">
                    Items per Page:
                    <a href="#" class="limit" style="text-decoration:underline">30</a>
                    <a href="#" class="limit">60</a>
                </div>
                <script>
                   bindEventsPoliticians("senators", "district_no");
                </script>
            </div> <!-- row-fluid -->
            <!-- <?php echo $this->Facebook->comments(); ?> -->
        </div>
        <div class="span1">
            <div style="position:fixed;">
                <a href='http://www.njleg.state.nj.us/SelectMun.asp' target='_blank'><img id="email" style="width:120px; height:80px;" src='<?php echo $this->webroot; ?>/img/email.png'></a>
        <!--This navigates the user to a page where they can select their district and e-mail their legislature.-->  
            </div>
            <script>
                $("#email").mouseover(function(){
                    $(this).attr("src", "<?php echo $this->webroot; ?>/img/email_open.png");
                });
                $("#email").mouseout(function(){
                    $(this).attr("src", "<?php echo $this->webroot; ?>/img/email.png");
                });
            </script> 

        </div>
        <?php $this->Js->writeBuffer(); ?>
    </body>
</html>
