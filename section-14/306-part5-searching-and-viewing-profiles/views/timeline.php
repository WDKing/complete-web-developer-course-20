<main role="main" class="flex-shrink-0">

	<div class="container-fluid main-container">

		<div class="row">
	    <div class="col-sm-8">
	    	<h2>Tweeters for You</h2>

	    	<?php displayTweets('isFollowing'); ?>
	    </div>
	    <div class="col-sm-4">
	    	<?php displaySearch() ?>
	    	<hr>
	    	<?php displayTweeterBox() ?>
	    </div>
	  </div>

	</div>

</main>

