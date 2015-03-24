<?php 
		include '../../../includes/Authenticate.php';
		include '../../../classes/student.php';
if(!isset($_SESSION['allow']) || $_SESSION['allow'] === "false" ){
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/login/');
	exit(0); }
		//check whether the user is logged in or not,
		Authenticate::preventUnauthorisedLogin();

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