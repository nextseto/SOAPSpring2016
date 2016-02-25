<!doctype html>
<html>
    <head>
            <?php $this->Html->script('jquery'); ?>
            <script type="text/javascript" src="<?php echo $this->webroot; ?>/js/userQuery.js"></script>
    </head>
    <body>
        <div class="span2">
            <?php echo $this->element('sidebar'); ?>
        </div>
<div class = "span10 ">
<div style ="text-align:center;margin-left:20%;">
                    <h1>Welcome to SOAP's Facilities Page</h1>
<h3>
You can search any facility name to find the facility. The facility will list the its address, the county it's in, its parent company, its danger level, and if it's a brownfield. Clicking on any facility will pull up further details on its location, the chemicals found on that site and their amounts, and will show the Google maps view of its location.
</h3><br>
        </div>
        <div class="span10" style="margin-left:20%;">
            <div style="text-align:center;"><input style="width:70%; padding-left:18px; background: white no-repeat scroll left center url('<?php echo $this->webroot; ?>img/icon_search.png');" id="mainSearchBar" type="text" placeholder="Search by facility name or click 'options' for more advanced searching."><a title="Options" id="select_cog" href="#"><img style="position:relative; z-index:100; margin-left:-60px; margin-top:-7px;" src="<?php echo $this->webroot; ?>img/icon_cog.png"></a></div>
            <div id="options" style="display:none; color:white; margin-bottom:20px;">
                <label class="filterLabel">Filters:</label><br>
                <label class="filterLabel">Facility Name</label><input class="filter" type="input"><br>
                <label class="filterLabel">Address</label><input class="filter" type="input"><br>
                <label class="filterLabel">County</label><input class="filter" type="input"><br>
                <label class="filterLabel">Parent Company</label><input class="filter" type="input"><br>
                <label class="filterLabel">Danger Level</label><input class="filter" type="input"><br>
                <label class="filterLabel">Brownfield</label><input class="filter" type="input"><br>
            </div>
            <table class="table table-striped" style="border-top: 0px;">
                <thead>
                    <tr>
			<!-- Tooltip hover information for table headers - Joie Murphy-->
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="facility_name" class="orderButton" style="color: #f5f3dc" title="The name of the factory, production site, or environmental waste cleaning facility that typically handles or handled dangerous chemicals.">Facility Name</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="location_id" class="orderButton" style="color: #f5f3dc" title="The current or former New Jersey address of a specific factory, production site, or environmental waste cleaning facility.">Address</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="county" class="orderButton" style="color: #f5f3dc" title="A political and administrative division of a state, providing certain local governmental services. New Jersey has 21 counties.">County</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="owner_name" class="orderButton" style="color: #f5f3dc" title="Parent companies will typically be larger firms that exhibit control over one or more small subsidiaries in either the same industry or other industries.">Parent Company</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="dangerous_state" class="orderButton" style="color: #f5f3dc" title="How are we measuring the danger level?">Danger Level</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="is_brownfield" class="orderButton" style="color: #f5f3dc" title="Real property, the expansion, redevelopment, or reuse of which may be complicated by the presence or potential presence of a hazardous substance, pollutant, or contaminant.">Brownfield</a></th>
                    </tr>
                </thead>
                <input id="currentOffset" type="hidden">
                <input id="currentCount" type="hidden">
		<input id="currentOrder" type="hidden">
                <input id="currentLimit" type="hidden" value=25>
                <tbody id="dataTable"> 
                </tbody>
            </table>
            <div class="row-fluid">
                <div class="span2" style="margin-top:12px; text-align:center;">
                    Page <span id="currentPage">1</span> of <span id="pageCount"></span><br><span id="totalResults"></span>	
                </div>
                <div id="pageList" class="span7 pagination pagination-centered">
                </div>
                <div class="span3" style="margin-top:12px; text-align:center;">
                    Items per Page:
                    <a href="#" class="limit" style="text-decoration:underline">25</a>
                    <a href="#" class="limit">50</a>
                    <a href="#" class="limit">75</a>
                    <a href="#" class="limit">100</a>
                </div>
                <script>
                   bindEvents("facilities", "facility_name");
                </script>
            </div> <!-- row-fluid -->
        </div>
        <?php $this->Js->writeBuffer(); ?>
    </body>
</html>


<!-- Function to call to enable tooltip feature - Joie Murphy -->
<script type = "text/javascript">
	$(function(){
		$("[rel='tooltip']").tooltip()
	});
</script>

<!-- Including necessary javascript for bootstrap tooltip - Joie Murphy -->
<script language='javascript' src='<?=$this->webroot?>js/jquery.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-alert.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-modal.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-transition.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-tooltip.js'></script>
