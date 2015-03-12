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

$queryResult = Student::viewChallenges();
date_default_timezone_set('Asia/Kolkata');
$currentTime = new DateTime();
$startTime = new DateTime();
$endTime = new DateTime();
$currentTime->setTimestamp(strtotime(date('Y-m-d H:i:s')));
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
						<th>Contest Name</th>
						<th>Contest Description</th>
						<th>Starts On</th>
						<th>Ends On</th>
						<th>Enter Challenge</th>
					</tr>
					</thead>
					<?php if (($queryResult)): ?>
						<tbody>
						<?php foreach($queryResult as $result): ?>
							<tr>
								<td><?php echo ++$index; ?></td>
								<td><?php echo $result['cName']; ?></td>
								<td><?php echo $result["cDesc"]; ?></td>
								<td><?php echo ($result["startDate"]);?></td>
								<td><?php echo ($result["endDate"]);?></td>
								<td><?php


									$startTime->setTimestamp(strtotime(($result["startDate"])));
									$endTime->setTimestamp(strtotime($result["endDate"]));
									if ($currentTime>=$startTime && $currentTime<=$endTime)
										echo "<a href='viewchallenge/index.php?cid=".$result["cId"]."&type=".$result["Type"]."'"."</a>"."Enter Challenge";
									else
										echo "Contest Ended";

									?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					<?php endif; ?>
				</table>
			</div>

<?php
include '../../views/template_footer.php';
?>