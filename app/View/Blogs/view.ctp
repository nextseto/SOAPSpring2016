<!-- File: /app/View/Blog/view.ctp -->
<!-- This file was made in the Fall 2014 Semester of CSC 415 (Software Engineering) for the Blogging in the Deep Group (12/1/14) -->
<!-- View post -->

<!-- Displays sidebar -->
<div class="sideView">
<div id="sidebarView" class="span2">

        <?php echo $this->element('sidebar'); ?>
</div>
</div>

<!-- Creates container for post -->
<div id="postContainer" class="span10">
	<!-- Actual post -->
	<div class="post">
		<!-- Delete button -->
		<form method="get" action="/SOAP/index.php/blogs/remove/<?php echo $blog_info[0][0]['id']; ?>" onsubmit="return confirm('Are you sure you want to delete this blog?')">
			<button id="deleteButton" class="btn" type="submit">Delete Blog</button>
		</form>
		<!-- Display Title of Post -->
		<h5 style="text-align:center;"> <?php echo $blog_info[0][0]['title']; ?></h5>
	    <hr />
	    
	    <!-- Display Body of Post -->
	    <h3> 
		<?php echo $blog_info[0][0]['body']; ?>
	    </h3>
	    <hr />
	</div>

	<br>
        <h1 id="commentTitle">Comments: </h1>
   	<br>

	 <!--	<div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'tcnjsoap'; // required: replace example with your forum shortname
        
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
    -->
   
    <!-- Facebook comment section -->
    <div class="facebook" width="100%">
    <?php echo $this->Facebook->comments(
            $options = array(
                //'width' => '300%',
                'mobile' => 'false'
                )
            );  ?>
  
   <!-- <a href="https://twitter.com/share" class="twitter-share-button" data-text="TCNJ SOAP" data-via="TCNJSoap" data-size="large">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>--> 
<!--	 
    <div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
    <a class="addthis_counter addthis_pill_style"></a>
    </div>
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script> 
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fe8fc260b784686"></script>
--> 
</div>
</div>	
</div>
