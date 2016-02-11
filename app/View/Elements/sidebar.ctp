<!--Andrew Preuss 11/9, Fixed position does not work well when viewing the site on mobile, doesn't actually look very good on the regular site either.  Can change the position attribute so that it is anchored to the page rather than the viewspace or change the size so that it is not contantly in the way of the user's view.  Will implement this once the VM is working. -->

<div class="well sidebar-nav" style="position:fixed; left:30px;">
	<ul class="nav nav-list" style="height: 100%">
		<li class="nav-header">Pollution</li>
		<li>
		<li>
	<!-- Brownfiels is the only one that doesn't work -->
			<?php //echo $this->Html->link('Brownfields',array('controller' => 'brownfields', 'action' => 'index', 'full_base' => true)); ?> 	
		</li>
		<li>
			<?php echo $this->Html->link('Chemicals',array('controller' => 'chemicals', 'action' => 'index', 'full_base' => true)); ?> 	
		
		<!--These are the Categories the user will see on the sidebar while on the Politics page.-->
		<li class="nav-header"><font color="#0B614B">Sites</font></li>
		<li>		
			<?php echo $this->Html->link('Chemicals',array('controller' => 'chemicals', 'action' => 'index', 'full_base' => true)); ?> 			
		</li>
		<li>
		</li>
			<?php echo $this->Html->link('Facilities',array('controller' => 'facilities', 'action' => 'index', 'full_base' => true)); ?> 	
					
		<li>
		<li>
		<li class="nav-header"><a href ="/SOAP/index.php/politicians"><font color="#0B614B">Politics</font></a></li>
		<!-- <li class="active"> -->
		<!-- The sidebar links for the politicians were broken. Fixed 10/12. -Kate Evans -->
		<li>

			<?php echo $this->Html->link('Senators',array('controller' => 'senators', 'action' => 'index', 'full_base' => true)); ?> 	
		</li>
		<li>
			<?php echo $this->Html->link('Assembly',array('controller' => 'representatives', 'action' => 'index', 'full_base' => true)); ?> 	
		</li>
		<!--<li>
			<a href="politicians">Lobbyists</a>
		</li>-->

		<!-- Adds Blog header and links to blog home page and add page (12/1/14) -->
		<li class="nav-header" id="SidebarTitle">Blog</li>
                <li>
                        <?php echo $this->Html->link('Blog Home',array('controller' => 'blogs', 'action' => 'index', 'full_base' => true)); ?>
                </li>
		<li>	
                        <?php echo $this->Html->link('Submit a Post',array('controller' => 'blogs', 'action' => 'add', 'full_base' => true)); ?>
		<li>
			<?php echo $this->Html->link('Advocacy Groups',array('controller' => 'advocacygroups', 'action' => 'index', 'full_base' => true)); ?>
		</li>
	</ul>
</div>
