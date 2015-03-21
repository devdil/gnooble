<?php

include '../../../includes/Authenticate.php';
include '../../../classes/student.php';

//check whether the user is logged in or not,
Authenticate::preventUnauthorisedLogin();

$queryResult = Student::viewDetailsSourceCode($_GET['qid'],$_SESSION['userid']);

?>
<?php
include '../../../views/template_header.php';
?>
			<h1 class="page-header">Source Code</h1>
			<p class="lead">Here is the detailed description</p>

			<?php if (isset($queryResult)): ?>
			<?php foreach ($queryResult as $item): ?>

			  <p>Status : <?php echo $item["Status"]; ?> </p>
			  <p>StartTime : <?php echo $item["startTime"]; ?> </p>
			  <p>EndTime : <?php echo $item["endTime"]; ?> </p>

			<?php // The trick is to use a <div> with a contenteditable attribute so that the area grows without any fancy JS! ?>
			<p>Sourcecode : </p>
			<textarea class="well well-sm" contenteditable="true" style="width: auto;height:1000px;"><?php echo ($item["SourceCode"]); ?></textarea>


			<?php endforeach; ?>

			<?php endif; ?>


<?php
include '../../../views/template_footer.php';
?>