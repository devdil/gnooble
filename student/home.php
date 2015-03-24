
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
	input[type='text'], button {
		padding: 5px 10px;
	}
</style>

<label>Enter Secure Code</label>
<input type="password" id="secureId"/>
<button id="submit">Check</button>

<script>
	// AJAX Code Here
	$('#submit').click(function() {
		// Okay, we need to get value from textbox name and score
		var txtname = $('#secureId').val();
	alert(txtname);
		// When user click on the add button
		// Let make a AJAX request
		$.ajax({
			url: 'ajax-data.php',
			dataType: 'json',
			type: 'POST', // making a POST request
			data: {
				secureId: txtname
			},
			
			success: function(data) {
				if (data == true)
				window.location.href = '<?php  echo 'http://'.$_SERVER['SERVER_NAME'].'/student/contests/';?>';
				else
				  alert("Invalid Code Dude!!");
				// this function will be trigger when our PHP successfully
				// response (does not mean it will successfully add to database)


			}
		})
	});

</script>












