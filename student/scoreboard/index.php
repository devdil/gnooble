<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

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
$scoreboardType = $_GET['type'];
	if ($scoreboardType=== 'cgf')
		$queryResult = Student::viewScoreboardBySourceCodeLength($_GET['qid']);
	elseif (($scoreboardType=== 'prc'))
		$queryResult = Student::viewScoreboard($_GET['qid']);

$index = 0;

?>
<?php
include '../../views/template_header.php';
?>
			<h1 class="page-header">Scoreboard</h1>
			<p class="lead">Here are the latest standings.</p>
			<?php if ($queryResult != false): ?>
			<?php if(($_GET['type'])=== 'cgf'): ?>
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>Sl no</th>
							<th>Name</th>
							<th>Status</th>
							<th>Solved In(secs)</th>
							<th>Chars</th>
							<th>Time</th>
							<th>Memory</th>

						</tr>
						</thead>
						<?php foreach($queryResult as $result): ?>
							<tr>
								<td><?php echo ++$index; ?></td>
								<td><?php echo $result["Name"]; ?></td>
								<td  style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
								if ($result["Status"] == 'Failed') echo "#c12e2a";
								if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
									<?php echo $result["Status"]; ?>
								</td>
								<td><?php echo $result["solvedIn"]  ?></td>
								<td><?php echo $result["lengthSourceCode"]  ?></td>
								<td><?php echo $result["Time"]  ?></td>
								<td><?php echo $result["Memory"]  ?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<?php endif;?>
			<?php if(($_GET['type'])=== 'prc'): ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Sl no</th>
						<th>Name</th>
						<th>Status</th>
						<th>Solved In(secs)</th>
						<th>Chars</th>
						<th>Time</th>
						<th>Memory</th>

					</tr>
					</thead>
					<?php foreach($queryResult as $result): ?>
						<tr>
							<td><?php echo ++$index; ?></td>
							<td><?php echo $result["Name"]; ?></td>
							<td  style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
													if ($result["Status"] == 'Failed') echo "#c12e2a";
													if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
								<?php echo $result["Status"]; ?>
							</td>
							<td><?php echo $result["solvedIn"]  ?></td>
							<td><?php echo $result["Time"]  ?></td>
							<td><?php echo $result["Memory"]  ?></td>

						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
			</div>
				<?php endif;?>
<?php endif; ?>

<?php
include '../../views/template_footer.php';
?>
