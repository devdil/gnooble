<?php

include '../../../includes/Authenticate.php';
include '../../../classes/student.php';

//check whether the user is logged in or not,
Authenticate::preventUnauthorisedLogin();

$queryResult = Student::viewDetailsSourceCode($_GET['qid'],$_SESSION['userid']);

// Get the question details
$questionResult = Student::getQuestion($_GET['qid']);

?>
<?php
include '../../../views/template_header.php';
?>
			<h1 class="page-header">Source Code</h1>
			<p class="lead">Here is your submission details for <a href="<?php echo "../../editor/editor.php?id=".$_GET['qid']."&type=prc"; ?>"><?php echo $questionResult[0]['questionName']; ?></a> problem.</p>

			<?php if (isset($queryResult)): ?>
			<?php foreach ($queryResult as $item): ?>

			  <p><strong>Status</strong> : <?php echo $item["Status"]; ?> </p>
			  <p><strong>StartTime</strong> : <?php echo $item["startTime"]; ?> </p>
			  <p><strong>EndTime</strong> : <?php echo $item["endTime"]; ?> </p>

			<?php // The trick is to use a <div> with a contenteditable attribute so that the area grows without any fancy JS! ?>
			<p><strong>Sourcecode</strong> : </p>
			<textarea class="well well-sm" contenteditable="true" style="width:100%;min-height:20em;"><?php echo ($item["SourceCode"]); ?></textarea>


			<?php endforeach; ?>

			<?php endif; ?>


<?php
include '../../../views/template_footer.php';
?>