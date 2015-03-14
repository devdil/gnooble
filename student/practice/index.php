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
		  <h1 class="page-header">Practice</h1>
		  <p class="lead">Start working on your coding skills right away.</p>



		  <div class="table-responsive">
		    <table class="table">
		      <thead>
		        <tr>
				  <th>Sl no</th>
		          <th>Question</th>
		          <th>Authored By</th>
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
		      		<td><?php echo "<a href='../editor/editor.php?id=".$result["questionId"]."&type=prc"."'"."</a>".$result["questionName"]; ?></td>
		      		<td><?php echo $result["AuthoredBy"]; ?></td>
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
		      		<td><?php
							if ($result["attempted"] === "0")
								echo "0%";
						    else
								echo ((($result["solved"])/($result["attempted"]))*100)."%";?></td>
					<td><?php echo "<a href='../scoreboard/index.php?qid=".$result["questionId"]."&type=prc"."'"."</a>"."Scoreboard"; ?></td>
		      	</tr>
		      <?php endforeach; ?>
		        
		      </tbody>
				<?php endif; ?>
		    </table>
		  </div>



			<?php
			include '../../views/template_footer.php';
			?>
