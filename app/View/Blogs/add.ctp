<!-- File: /app/View/Posts/add.ctp -->
<!-- This file was made in the Fall 2014 Semester of CSC 415 (Software Engineering) for the Blogging in the Deep Group (12/1/14) -->
<!-- Submit a Post -->

<!-- Display Sidebar -->
<div class="span2">
	
	 <?php echo $this->element('sidebar'); ?>
</div>

<!-- Blog Form -->
<div class="span9">
    <!-- link to Return to Blog Home page -->
    <a title="Return to Blog" id="returnLink" href="/SOAP/index.php/blogs">⬅ Return to Blog</a>
    <?php echo $this->Session->flash();?>	
    
    <br>
    <br>
    
    <h2>Add Post</h2>
	 
    <!-- Create Blog form and display text field for title -->   
    <?php	
        echo $this->Form->create('Blog', array('action' => 'submit' )); // submit calls from the blog controller function
        echo $this->Form->input('title', array('id'=>'addTitle','maxlength'=>'64')); 
     ?>

    <h3 id="addBody">Body</h3>      
    
    <!-- Adds text field for body using CKEditor and creates submit button --> 
    <?php       
	echo $this->Form->textarea('body',array('class'=>'ckeditor'));
        echo "<br>";
 	echo $this->Form->end('Submit Post');
     ?>

</div>

