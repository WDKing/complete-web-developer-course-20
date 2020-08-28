	<footer class="footer mt-auto py-3">
		<div class="container">
	    <span class="text-muted">
	    	&copy; Teacher's Website 2016
	    </span>
	  </div>
	</footer>

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- Modal -->
	<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-modal-title" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="login-modal-title">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" id="login-alert"></div>
					<form>
						<input type="hidden" id="login-active" name="login-active" value="1">
					  <div class="form-group">
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" id="email" placeholder="Email address">
					  </div>
					  <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" class="form-control" id="password" placeholder="Password">
					  </div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn bg-transparent" id="toggle-login">Sign Up</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="login-signup-button">Log In</button>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$("#toggle-login").click(function() {
				if($("#login-active").val() == "1") {
					$("#login-active").val("0");
					$("#login-modal-title").html("Sign Up");
					$("#login-signup-button").html("Sign Up");
					$("#toggle-login").html("Log In");
				} else {
					$("#login-active").val("1");
					$("#login-modal-title").html("Log In");
					$("#login-signup-button").html("Log In");
					$("#toggle-login").html("Sign Up");
				}
			});

		$("#login-signup-button").click(function() {
				$.ajax({
					type: "POST",
					url: "actions.php?action=loginSignup",
					data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#login-active").val() + "",
					success: function(result) {
	            if(result == "1") {
	            	window.location.assign("http://localhost/section-14/305-part4-posting-a-tweet/");
	            } else {
	            	$("#login-alert").html(result).show();
	            }
					  }
				});
			});

		$(".follow-button").click(function() {
				var id = $(this).attr("data-userId");

				$.ajax({
						type: "POST",
						url: "actions.php?action=toggleFollow",
						data: "userId=" + $(this).attr("data-userId"),
						success: function(result) {
							if(result == "1") {
								$("button[data-userId='" + id + "']").html("Follow");
							}
							if(result == "2") {
								$("button[data-userId='" + id + "']").html("Unfollow");
							}
						}
					});
			});

		$("#tweeter-button").click(function() {
				$.ajax({
						type: "POST",
						url: "actions.php?action=postTweeter",
						data: "tweetContent=" + $("#tweeter-post").val(),
						success: function(result) {
							if (result == "1") {
								$("#tweeter-success").show();
								$("#tweeter-error").hide();
								$("#tweeter-post").val("");
							} else if (result != "") {
								$("#tweeter-error").html(result).show();
								$("#tweeter-success").hide();
							}
						}
					});
			})

	</script>
	
</body>
</html>