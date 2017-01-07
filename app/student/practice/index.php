<?php 
		include '../../includes/Authenticate.php';
		include '../../classes/student.php';

		//check whether the user is logged in or not,
	Authenticate::preventUnauthorisedLogin();

		$queryResult = Student::viewPracticeQuestions();

		$index = 0;

?>
<?php
include '../../views/template_header.php';
?>
<div class="page-header clearfix">
   <h1 class="pull-left">Practice</h1>
   <form class="form-inline pull-right prc-search" action="" method="post">
      <div class="form-group">
         <input name="prcsearch" class="form-control" type="text" required placeholder="Search practice questions"/>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
   </form>
</div>

<div class="clearfix">
<p class="lead pull-left">Start working on your coding skills right away.</p>
<form class="form-inline pull-right" method="post" action="">
   <label for="prcsort">Sort By: </label>
   <select class="form-control input-sm" name="prcsort" id="prcsort">
      <option value="easy">Difficulty: Easy to Difficult</option>
      <option value="difficult">Difficulty: Difficult to Easy</option>
      <option value="latest">Latest Questions</option>
      <option value="popular">Popular Questions</option>
   </select>
</form>
</div>


<div class="questions-container">
   <?php if (($queryResult)): ?>
   <?php foreach($queryResult as $result): ?>
   <div class="question">
      <a class="btn pull-right btn-default btn-grey" href="<?php echo "../scoreboard/index.php?qid=".$result["questionId"]."&type=prc"; ?>">View Scores</a>
      <h4><a href="<?php echo "../editor/editor.php?id=".$result["questionId"]."&type=prc"; ?>"><?php echo $result["questionName"]; ?></a></h4>
      <div class="q-meta">
         <p class="meta-item author text-muted">Posted by: <em><?php echo $result["AuthoredBy"]; ?></em></p>
         <p class="meta-item type text-center text-muted"><strong>Difficulty:</strong>
         <?php switch($result["difficulty"])
         {
            case 20:
               echo '<span class="label label-success">Easy</span>';
               break;
            case 50:
               echo '<span class="label label-warning">Medium</span>';
               break;
            case 100:
               echo '<span class="label label-danger">Hard</span>';
               break;
            default:
               echo '<span class="label label-default">Not Assigned</span>';
         }
         ?>
         </p>
         <p class="meta-item accuracy text-muted text-center"><strong>Accuracy:</strong>
            <?php
               if ($result["attempted"] === "0")
                  echo "0%";
               else
                  echo ((($result["solved"])/($result["attempted"]))*100)."%";
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
