<!doctype html>
<html>

<head>
    <?php $this->Html->script('jquery'); ?>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>/js/userQuery.js"></script>
</head>

<body>
    <div class="span9"/>
    <div class="span2">
        <?php echo $this->element('sidebar'); ?>
    </div>
    <div class="span10">
        <div style="text-align:center;margin-left:20%;">
            <br>
            <h1 style="font-size: 40px;">Chemicals</h1>
            <h3>You can search any chemical name to find the chemical. The chemical will list if it's carcinogenic, whether the clean air act bans it, whether its a metal, and whether it's a PBT which are chemicals that are toxic and pose a risk to humans. Clicking the chemical will bring up all its information and facilities that might contain it. </h3>
            <br>
        </div>

        <div class="span10" style="margin-left:20%;">
            <div class="input-group">
                <div class="input-group-addon">Search</div>
                <input type="text" class="form-control" id="mainSearchBar" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <a title="Options" id="select_cog" href="#"><img style="position:relative; z-index:100; margin: 8px 0 0 -65px;" src="<?php echo $this->webroot; ?>img/icon_cog.png"></a>
            </div>

            <div id="options" style="display:none; color:white; margin-bottom:20px;">
                <label class="filterLabel">Filters:</label>
                <br>
                <label class="filterLabel">Chemical Name</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Carcinogenic</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Clean Air Act</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">Metal</label>
                <input class="filter" type="input">
                <br>
                <label class="filterLabel">PBT</label>
                <input class="filter" type="input">
                <br>
            </div>

            <table class="table table-striped" style="border-top: 0px;">
                <thead>
                    <tr>
                        <th class="span3" style="width:auto"><a href="#" rel="tooltip" id="chemical_name" class="orderButton" style="color: #F5F3DC" title="Chemicals commonly associated with hazardous waste.">Chemical Name</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="carcinogenic" class="orderButton" style="color: #F5F3DC" title="Any type of substance, pollutant, or contaminant having the potential to cause cancer.">Carcinogenic</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="clean_air_act" class="orderButton" style="color: #F5F3DC" title="The Clean Air Act (CAA) is the federal law that regulates air emissions from stationary and mobile sources.">Clean Air Act</a></th>
                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="metal" class="orderButton" style="color: #F5F3DC" title="A solid material that is typically hard, shiny, malleable, fusible, and ductile, with good electrical and thermal conductivity. Some metals are aluminum, copper, silver, lead, etc.">Metal</a></th>

                        <th class="span3" style="width:auto;"><a href="#" rel="tooltip" id="pbt" class="orderButton" style="color: #F5F3DC" title="PBT pollutants are chemicals that are toxic and pose risks to human health and ecosystems.">PBT</a></th>
                    </tr>
                </thead>
                <input id="currentOffset" type="hidden">
                <input id="currentCount" type="hidden">
                <input id="currentOrder" type="hidden">
                <input id="currentLimit" type="hidden" value=25>
                <!-- Important!! This contains the 'cell' elements that contain the: chemical name and properties of this chemical. This is dynamically created. (NOT HARD CODED!!!) -->
                <tbody id="dataTable">
                </tbody>
            </table>

            <!--Number pagination, skip to a different page or alter how many items on each page-->
            <div class="row-fluid">
                <div class="span2" style="margin-top:12px; text-align:center;">
                    Page <span id="currentPage">1</span> of <span id="pageCount"></span>
                    <br><span id="totalResults"></span>
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
                    bindEvents("chemicals", "chemical_name");
                </script>
            </div>
            <!-- row-fluid -->
        </div>
        <?php $this->Js->writeBuffer(); ?>
    </div>
</body>

</html>

<!-- Function to call to enable tooltip feature -->
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip()
    });
</script>

<!-- Including necessary javascript for bootstrap tooltip - Joie Murphy -->
<script language='javascript' src='<?=$this->webroot?>js/jquery.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-alert.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-modal.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-transition.js'></script>
<script language='javascript' src='<?=$this->webroot?>js/bootstrap-tooltip.js'></script>