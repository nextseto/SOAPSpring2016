/** Original source code: https://parall.ax/blog/view/3109/tutorial-retrieving-tweets-from-the-twitter-v1-1-api-using-oauth-php-javascript 
  * Changes made to filter tweets by location and an additional keyword: Kyle 
  */
var get_tweets = function(){
    var location = document.getElementsByName("location")[0].value;
	/** Gets the keyword by which the user wishes to filter the tweets */
	var keyword = document.getElementsByName("keyword")[0].value;
    
    console.log("location: " + location);
    console.log("keyword: " + keyword);
	$.ajax({
		url: 'get_tweets.php',
		type: 'GET',
		success: function(response) {
			if (typeof response.errors === 'undefined' || response.errors.length < 1) {
				var $tweets = $('<ul></ul>');
				/** Goes through each part of the statuses array within response */
				$.each(response.statuses, function(i, obj) {
					/** If the location is an empty string (the user did not indicate they wanted to filter it)
				      * then we just list all tweets about brownfields 
					  */
					if (location == "" && keyword == "") {
						$tweets.append('<li class="  h-entry tweet  with-expansion  customisable-border">' + obj.text + '</li>');
					}
					/** If the user indicates both keyword and location, then we will only display tweets that fulfill
					  * both of those conditions
					  */
					else if (location != "" && keyword != "") {
						if (obj.text.indexOf(keyword) > -1 && obj.user.location == location) {
							$tweets.append('<li class="  h-entry tweet  with-expansion  customisable-border">' + obj.text + '</li>');
						}
					} 
					/** If the user entered no location, then they must have entered a keyword */
					else if (location == ""){
						/** If there are any tweets with the keyword that the user indicated */
						if (obj.text.indexOf(keyword) > -1) {
							/** Then we display those tweets - otherwise, the user sees nothing */
							$tweets.append('<li class="  h-entry tweet  with-expansion  customisable-border">' + obj.text + '</li>');
						}
					}
					/** If the user entered no keyword, then they must have entered a location*/
					else {
						/** If there are any tweets whose location matches the one the user indicated */
						if (obj.user.location == location) {
							/** Then we display those tweets, otherwise we display nothing */
							$tweets.append('<li class="  h-entry tweet  with-expansion  customisable-border">' + obj.text + '</li>');
						}
					}
				
				});
                /**Display the tweets in the tweets-container div*/
				$('.tweets-container').html($tweets);
			} else {
				$('.tweets-container p:first').text('Response error');
			}
		},
		error: function(errors) {
			$('.tweets-container p:first').text('Request error');
		}
	});
};

$(function(){
	/** Gets the location by which the user wishes to filter the tweets */
	get_tweets();
});