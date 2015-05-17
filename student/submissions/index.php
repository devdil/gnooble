<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

//check whether the user is logged in or not,
Authenticate::preventUnauthorisedLogin();

$queryResult = Student::getMySubmissions($_SESSION['userid']);


?>
<?php
include '../../views/template_header.php';
?>
			<h1 class="page-header">My Submissions</h1>
<div class="clearfix">
			<p class="lead pull-left">Here are the submissions you have made so far</p>
<form class="form-inline pull-right" action="" method="post">
   <div class="form-group">
      <label for="subfilter">Filter By: </label>
      <select class="form-control" name="subfilter" id="subfilter">
         <option value="all">All Submissions</option>
         <option value="private">Private Submissions</option>
         <option value="public">Public Submissions</option>
      </select>
   </div>
</form>
</div>



<div class="questions-container">
   <?php if (($queryResult)): ?>
      <?php foreach($queryResult as $result): ?>
         <div class="question">
            <a class="btn pull-right btn-default btn-grey" href="<?php echo "source/index.php?qid=".$result["questionId"]; ?>">View Submission</a>
            <h4><a href="<?php echo "../editor/editor.php?id=".$result["questionId"]."&type=prc"; ?>"><?php echo $result["questionName"]; ?></a></h4>
            <div class="q-meta">
               <?php if($result["Status"] == 'Solved'): ?>
               <p class="meta-item author text-success text-uppercase">
                  <?php elseif($result["Status"] == 'Failed'): ?>
               <p class="meta-item author text-danger text-uppercase">
                  <?php elseif($result["Status"] == 'Attempted'): ?>
               <p class="meta-item author text-uppercase" style="color:#eb9316;">
                  <?php else: ?>
               <p class="meta-item author text-muted text-uppercase">
                  <?php endif; ?>
                  <em><?php echo $result["Status"]; ?></em>
               </p>
               <p class="meta-item type text-center text-muted"><strong>Difficulty:</strong>
                  <?php switch($result["difficulty"])
                  {
                     case 20:
                        echo '<span class="label label-success">Easy</span>';
                        break;
                     case 50:
                        echo "Medium";
                        echo '<span class="label label-warning">Medium</span>';
                        break;
                     case 100:
                        echo "Hard";
                        echo '<span class="label label-danger">Hard</span>';
                        break;
                     default:
                        echo '<span class="label label-default">Not Assigned</span>';
                  }
                  ?>
               </p>
            </div>
         </div>
      <?php endforeach; ?>
   <?php endif; ?>
</div>

			<?php
			include '../../views/template_footer.php';
			?>
