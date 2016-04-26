//   Alana Huszar
//   CSC415
//   The Tables Have Turned -->

function bindEvents(modelName, orderBy){
    filterSearch(0, modelName, orderBy, 0, 25);
    
    $(document).on("focus", "#mainSearchBar", function(){
        $("#options").hide();
    });

    // Sorts objects by id when orderButton is clicked on. Prevents the default from being reverted to when page is changed. This will also toggle sorting by  descending/ascending with multiple clicks. 
    $(document).on("click", ".orderButton", function(e){
        var myID = $(this).attr("id");
	if(myID==$("#currentOrder").val()) {
		filterSearch(e, modelName, myID + " DESC", 0, $("#currentLimit").val());
	}
	else{
		filterSearch(e, modelName, myID,0,$("#currentLimit").val());
	}
        e.preventDefault();
    });

    $(document).on("click", "#select_cog", function(e){
        e.preventDefault();
        $("#options").toggle();
    });

    //filters content based on search, keeps current ordering and page limit.
    $(document).on("keyup", "#mainSearchBar", function(e){
        $(".filter").each(function(){
            $(this).val("");
        });
        $(".filter").first().val($("#mainSearchBar").val());
        filterSearch(e, modelName, $("#currentOrder").val(), 0, parseInt($("#currentLimit").val()));
    });

    $(document).on("keyup", ".filter", function(e){
        filterSearch(e, modelName, $("#currentOrder").val(), 0, parseInt($("#currentLimit").val()));
    });

    //Changes page, keeping the same order and limit
    $(document).on("click", ".pageNum", function(e){
        e.preventDefault();
        $(".pageNum").each(function(){
            $(this).css("text-decoration", "");
            $(this).css("color", "#f5f3dc");
        });
        $(this).css("text-decoration", "underline");
        $(this).css("color", "lightgreen");
        filterSearch(e, modelName, $("#currentOrder").val(), parseInt($(this).attr("name")), parseInt($("#currentLimit").val()));
    });

    //Changes number of items on each page, without changing the ordering of the items
    $(document).on("click", ".limit", function(e){
        e.preventDefault();
        $(".limit").each(function(){
            $(this).css("text-decoration", "");
        });
        $(this).css("text-decoration", "underline");
        filterSearch(e, modelName, $("#currentOrder").val(), 0, parseInt($(this).html()));
        $(".pageNum").each(function(){
            $(this).css("text-decoration", "");
            $(this).css("color", "#f5f3dc");
        });
        $(".pageNum").first().css("text-decoration", "underline");
        $(".pageNum").first("color", "lightgreen");
    });
}

function bindEventsPoliticians(modelName, orderBy){
    filterSearchPoliticians(0, modelName, orderBy, 0, 30);
    
    $(document).on("focus", "#mainSearchBar", function(){
        $("#options").hide();
    });

    $(document).on("click", "#select_cog", function(e){
        e.preventDefault();
        $("#options").toggle();
    });

    $(document).on("keyup", "#mainSearchBar", function(e){
        $(".filter").each(function(){
            $(this).val("");
        });
        $(".filter").first().val($("#mainSearchBar").val());
        filterSearchPoliticians(e, modelName, orderBy, 0, parseInt($("#currentLimit").val()));
    });

    $(document).on("keyup", ".filter", function(e){
        filterSearchPoliticians(e, modelName, orderBy, 0, parseInt($("#currentLimit").val()));
    });

    $(document).on("click", ".pageNum", function(e){
        e.preventDefault();
        $(".pageNum").each(function(){
            $(this).css("text-decoration", "");
            $(this).css("color", "#f5f3dc");
        });
        $(this).css("text-decoration", "underline");
        $(this).css("color", "lightgreen");
        filterSearchPoliticians(e, modelName, orderBy, parseInt($(this).attr("name")), parseInt($("#currentLimit").val()));
    });

    $(document).on("click", ".limit", function(e){
        e.preventDefault();
        $(".limit").each(function(){
            $(this).css("text-decoration", "");
        });
        $(this).css("text-decoration", "underline");
        filterSearchPoliticians(e, modelName, orderBy, 0, parseInt($(this).html()));
        $(".pageNum").each(function(){
            $(this).css("text-decoration", "");
            $(this).css("color", "#f5f3dc");
        });
        $(".pageNum").first().css("text-decoration", "underline");
        $(".pageNum").first("color", "lightgreen");
    });
}

function filterSearch(event, modelName, orderBy, offsetNum, limit){
    if(event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40){
        var filters = [];
        var i = 0;
        $(".filter").each(function(){
            filters[i] = $(this).val().split(" ");
            i++;                           
        });
        $.ajax({
            type: "POST",
            url: "/cabect/SOAP/index.php/" + modelName + "/loadTable",
            data: {
                limit: limit,
                order: orderBy,
                offset: offsetNum*limit,
                filters: filters
            },
            beforeSend: function(){
                $("#dataTable").html("Thinking...");
            },
            success: function(data){
                $("#dataTable").html("");
                data = JSON.parse(data);
                count = parseInt(data[0]);
                $("#currentOffset").val(offsetNum);
                $("#currentCount").val(count);
                $("#currentLimit").val(limit);
		$("#currentOrder").val(orderBy);
                if(count == 0){
                    $("#currentPage").html("1");
                    $("#pageCount").html("1");
                    $("#totalResults").html("(0 results)");
                    $("#dataTable").append("No results found.");
                }
                else{
                    $("#currentPage").html(offsetNum+1);
                    $("#pageCount").html(Math.ceil(count / limit));
                    $("#totalResults").html("(" + count + " results)");
                    data = data[1];
                    for(var i = 0; i < data.length; i++){
                        var tableRow = "<tr><td class='span3' style='width:auto;'><a href='" + modelName + "#" + data[i][0][Object.keys(data[0][0])[0]] + "'>" + data[i][0][Object.keys(data[0][0])[1]] + "</a></td>";
                        for(var j = 2; j < Object.keys(data[0][0]).length; j++){
                            tableRow += "<td class='span3' style='width:auto;'>" + data[i][0][Object.keys(data[0][0])[j]] + "</td>";
                        }
                        tableRow += "</tr>";
                        $("#dataTable").append(tableRow);
                    }
                }
                $("#pageList").html("");
                $("#pageList").append("<ul><a href='#' name='" + 0 + "' class='pageNum'>First</a></ul>");
		for(var i = offsetNum-4; i < offsetNum+5; i++){
                    if(i < 0 || i >= Math.ceil(count / limit)){
                        continue;
                    }
                    if(i == offsetNum){
                        $("#pageList").append("<ul><a style='color:lightgreen; text-decoration:underline;' href='#' name='" + i + "' class='pageNum'>" + (i+1) + "</a></ul>");
                    }
                    else{
                        $("#pageList").append("<ul><a href='#' name='" + i + "' class='pageNum'>" + (i+1) + "</a></ul>");
                    }
                }
              //adds a "last" page button. If the count of results is zero, sets the last page to the first page.
	      if(Math.ceil(count)==0)	{
		$("#pageList").append("<ul><a href='#' name='" + 0 + "' class='pageNum'>Last</a></ul>");
              }
	      else{
	        $("#pageList").append("<ul><a href='#' name='" +( Math.ceil(count / limit)-1) + "' class='pageNum'>Last</a></ul>");
              }
	   }
        });
    }
}

function filterSearchPoliticians(event, modelName, orderBy, offsetNum, limit){
    if(event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40){
        var filters = [];
        var i = 0;
        $(".filter").each(function(){
            filters[i] = $(this).val().split(" ");
            i++;                           
        });
        $.ajax({
            type: "POST",
            url: "/cabect/SOAP/index.php/" + modelName + "/loadTable",
            data: {
                limit: limit,
                order: orderBy,
                offset: offsetNum*limit,
                filters: filters
            },
            beforeSend: function(){
                $("#politicianList").html("<div style='width:100%; text-align:center;'>Thinking...</div>");
            },
            success: function(data){
                $("#politicianList").html("");
                data = JSON.parse(data);
                count = parseInt(data[0]);
                $("#currentOffset").val(offsetNum);
                $("#currentCount").val(count);
                $("#currentLimit").val(limit);
                if(count == 0){
                    $("#currentPage").html("1");
                    $("#pageCount").html("1");
                    $("#totalResults").html("(0 results)");
                    $("#politicianList").append("<div style='width:100%; text-align:center;'>No results found.</div>");
                }
                else{
                    $("#currentPage").html(offsetNum+1);
                    $("#pageCount").html(Math.ceil(count / limit));
                    $("#totalResults").html("(" + count + " results)");
                    data = data[1];
                    for(var i = 0; i < data.length; i++){
                        var listItem = "<li class='span3'><div class='thumbnail'><img src='" + data[i][0]["image_link"] + "'><div class='caption' style='text-align:center;'><h3 style='color:#F5F3DC;'>" + data[i][0]['name'] + "</h3><h4 style='color:#F5F3DC;'>Year Elected: " + data[i][0]['date_elected'] + "</h4><h4 style='color:#F5F3DC;'>";
                        listItem += data[i][0]['party'];
                        listItem += "</h4><h4 style='color:#F5F3DC;'>District Number: " + data[i][0]['district_no'] + "</h4>";
                        listItem += "<br></div></div></li>";
                        $("#politicianList").append(listItem);
                    }
                }
                $("#pageList").html("");
                for(var i = offsetNum-4; i < offsetNum+5; i++){
                    if(i < 0 || i >= Math.ceil(count / limit)){
                        continue;
                    }
                    if(i == offsetNum){
                        $("#pageList").append("<ul><a style='color:lightgreen; text-decoration:underline;' href='#' name='" + i + "' class='pageNum'>" + (i+1) + "</a></ul>");
                    }
                    else{
                        $("#pageList").append("<ul><a href='#' name='" + i + "' class='pageNum'>" + (i+1) + "</a></ul>");
                    }
                }
            }
        });
    }
}
