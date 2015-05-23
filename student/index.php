<?php

include '../includes/Authenticate.php';
include '../classes/student.php';

  Authenticate::preventUnauthorisedLogin();

 $queryResult = Student::getQuestionsSolved($_SESSION['userid']);
 $queryUserDetails = Student::getUserDetails($_SESSION['userid']);

include '../views/template_header.php';
?>
		  <h1 class="page-header">Home</h1>
		  <p class="lead">Welcome Aboard!</p>


		   <div>
			  <div class="col-md-6 clearfix user-profile">
				 <img class="user-img pull-left img-rounded img-responsive col-md-4 col-sm-4 col-xs-4" src="https://cdn2.iconfinder.com/data/icons/flat-style-svg-icons-part-2/512/hacker_user_thief_spy_skull-512.png" alt="Sougata Nair"/>

				 <div class="user-info pull-left col-md-7 col-md-7 col-xs-7">
				<?php if (isset($queryResult) && isset($queryUserDetails)): ?>
					<h2><strong><?php echo $queryUserDetails[0]['Name'];?></strong></h2>

					<p class="dept meta"><?php echo $queryUserDetails[0]['Department'];?></p>
					<p class="text-primary">Unique Student ID: <?php echo $_SESSION['userid']; ?></p>
					<p class="dept meta"><?php echo $queryUserDetails[0]['EmailId'];?></p>

				<?php endif; ?>

				 </div>
			  </div>
		   </div>

<?php
include '../views/template_footer.php';
?>