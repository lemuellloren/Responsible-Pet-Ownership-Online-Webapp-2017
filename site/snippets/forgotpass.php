<section id="forgotpass" class="grid-container">
	
	<h1>Reset Password</h1>
	<div id='successreset'></div>
	<form action="" id="ForgotPassForm">
		<div class="form-group">
			<input type="password" class="form-control" name="password" id="userpass" required/>
			<label for="userpass" class="animated-label">Password</label>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="confirm_password" id="cuserpass" required/>
			<label for="cuserpass" class="animated-label">Confirm Password</label>
		</div>

		<button type="submit" class="btnOne radial">Save</button>
	</form>
</section>

<script type="text/javascript">
	(function(){
		'use strict';

		var $forgotForm = $('#ForgotPassForm');

		$forgotForm.on('submit', function(e){
			e.preventDefault();

			var token = '<?php echo $_GET["token"] ?>';

			$.ajax({
				url: '<?php echo url() ?>/api/changepasstoken/?token=' + token,
				data: $forgotForm.serialize(),
				dataType: 'json',
				method: 'POST',
				success: function(data) {
					var alert = alertBox('Your password has been reset successfully', 'success');
	                $('#successreset').append(alert);
	                autoHide('reload', 'home');
				},
				error: function(xhr, text, error) {
					var alerterr = alertBox(xhr.responseJSON.message, 'error');
	                $('#successreset').append(alerterr);
	                autoHide('reload');
				}
			});
		});
	})();
</script>