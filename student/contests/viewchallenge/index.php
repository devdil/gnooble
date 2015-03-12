<?php 
		include '../../../includes/Authenticate.php';
		include '../../../classes/student.php';

		//check whether the user is logged in or not,
		if (!Authenticate::isLoggedIn())
		{
			Authenticate::logout();
		}
		//protects the student section
		if (Authenticate::getUserType() != "STUDENT")
		{
			Authenticate::redirect();
		}

		$queryResult = Student::viewChallengeQuestions($_GET['cid']);

		$index = 0;

?>
<?php
include '../../../views/template_header.php';
?>
		  <h1 class="page-header">Practice</h1>
		  <p class="lead">Start working on your coding skills right away.</p>

		  <div class="table-responsive">
		    <table class="table">
		      <thead>
		        <tr>
				  <th>Sl no</th>
		          <th>Question</th>
		          <th>Difficulty</th>
		          <th>Accuracy</th>
				  <th>Scoreboard</th>
		        </tr>
		      </thead>
				<?php if (($queryResult)): ?>
		      <tbody>
		      	<?php foreach($queryResult as $result): ?>
		      	<tr>
					<td><?php echo ++$index; ?></td>
		      		<td><?php echo "<a href='../../editor/editor.php?id=".$result["questionId"]."&type=".$_GET["type"]."'"."</a>".$result["questionName"]; ?></td>
		      		<td><?php switch($result["difficulty"])
                        {
                            case 20:
                                echo "Easy";
                                break;
                            case 50:
                                echo "Medium";
                                break;
                            case 100:
                                echo "Hard";
                                break;
                            default:
                                echo "Not Assigned";
                        }
                        ?>
                    </td>
					<td><?php echo "<a href='../../../student/scoreboard/index.php?qid=".$result["questionId"]."&type=".$_GET["type"]."'"."</a>"."Scoreboard"; ?></td>
		      	</tr>
		      <?php endforeach; ?>
		        
		      </tbody>
				<?php endif; ?>
		    </table>
		  </div>

<?php
include '../../../views/template_footer.php';
?>