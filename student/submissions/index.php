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
			<p class="lead">Here are your submissions.</p>


			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Question Name</th>
						<th>Status</th>
						<th>Difficulty</th>
						<th>View SourceCode</th>
					</tr>
					</thead>
					<?php if ($queryResult): ?>
					<tbody>
					<?php foreach($queryResult as $result): ?>
						<tr>
							<td><?php echo $result["questionName"]; ?></td>
							<td style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
							                       if ($result["Status"] == 'Failed') echo "#c12e2a";
							                       if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
												<?php echo $result["Status"]; ?>
							</td>
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
							<td><?php echo "<a href='source/index.php?qid=".$result["questionId"]."'"."</a>"."View Code";?></td>
						</tr>
					<?php endforeach; ?>

					</tbody>
					<?php endif; ?>
				</table>
			</div>

			<?php
			include '../../views/template_footer.php';
			?>
