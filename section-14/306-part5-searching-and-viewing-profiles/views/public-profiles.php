<main role="main" class="flex-shrink-0">

	<div class="container-fluid main-container">

		<div class="row">
	    <div class="col-sm-8">
	    	<?php if (array_key_exists('userid', $_GET)) { ?>

	    		<?php displayTweets($_GET['userid']); ?>

    		<?php } else { ?>

		    	<h2>Active Users</h2>
		    	<?php displayUsers(); ?>

    		<?php } ?>
	    </div>
	    <div class="col-sm-4">
	    	<?php displaySearch() ?>
	    	<hr>
	    	<?php displayTweeterBox() ?>
	    </div>
	  </div>

	</div>

</main>

