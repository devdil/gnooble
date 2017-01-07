<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

//check whether the user is logged in or not,
Authenticate::preventUnauthorisedLogin();

$scoreboardType = $_GET['type'];
	if ($scoreboardType === 'cgf')
		$queryResult = Student::viewScoreboardBySourceCodeLength($_GET['qid']);
	elseif (($scoreboardType === 'prc'))
		$queryResult = Student::viewScoreboard($_GET['qid']);

$index = 0;

// Get the question details
$questionResult = Student::getQuestion($_GET['qid']);

?>

<?php
include '../../views/template_header.php';
?>

			<h1 class="page-header">Scoreboard <small>for <a href="<?php echo "../editor/editor.php?id=".$_GET['qid']."&type=prc"; ?>"><?php echo $questionResult[0]['questionName']; ?></a></small></h1>
<!--			<p class="text-primary pull-right">Your StudentId : --><?php //echo $_SESSION['userid'];?><!--</p>-->
<div class="recap-container">
   <div class="question-recap">
      <?php echo html_entity_decode($questionResult[0]['questionStatement']); ?>
   </div>
   <a id="see-more" data-seen="false" href="#">See More ...</a>
</div>
			<p class="lead">Here are the latest standings.</p>
<?php if ($queryResult != false): ?>

			<?php if(($_GET['type']) === 'cgf'): ?>
      <div class="questions-container">
         <?php if (($queryResult)): ?>
            <?php foreach($queryResult as $result): ?>
               <div class="question clearfix">
                  <div class="meta-container col-md-4 col-xs-4 col-sm-4">
                     <h4><?php echo $result["Name"]; ?></h4>
                     <div class="sb-meta">
                        <p class="meta-item text-muted">Rank: <?php echo ++$index; ?></p>
                        <p class="meta-item type text-center text-muted">
                           <?php switch($result["Status"])
                           {
                              case $result["Status"] == 'Solved':
                                 echo '<span class="text-uppercase text-success">'.$result["Status"].'</span>';
                                 break;
                              case $result["Status"] == 'Failed':
                                 echo '<span class="text-uppercase text-danger">'.$result["Status"].'</span>';
                                 break;
                              case $result["Status"] == 'Attempted':
                                 echo '<span class="text-uppercase" style="color: #eb9316;">'.$result["Status"].'</span>';
                                 break;
                              default:
                                 echo '<span class="text-uppercase text-muted">Not Assigned</span>';
                           }
                           ?>
                        </p>
                     </div>
                  </div>
                  <div class="stats-container col-md-8 col-lg-8 col-sm-8">
                     <ul class="list-inline stat-list text-right">
                        <li class="source-length text-center">
                           <span class="text-uppercase">Wrote</span>
                           <?php echo $result["lengthSourceCode"];  ?>
                           <span class="text-uppercase">Lines</span>
                        </li>
                        <li class="compile-time text-center">
                           <span class="text-uppercase">Compile Time</span>
                           <?php echo $result["Time"];  ?>
                           <span class="text-uppercase">seconds</span>
                        </li>
                        <li class="memory-time text-center">
                           <span class="text-uppercase">Consumed</span>
                           <?php echo $result["Memory"];  ?>
                           <span class="text-uppercase">memory</span>
                        </li>
                     </ul>
                  </div>
               </div>
            <?php endforeach; ?>
         <?php endif; ?>
      </div>
				<?php endif;?>
			<?php if(($_GET['type'])=== 'prc'): ?>
      <div class="questions-container">
         <?php if (($queryResult)): ?>
            <?php foreach($queryResult as $result): ?>
               <div class="question clearfix">
                  <div class="meta-container col-md-4 col-xs-4 col-sm-4">
                  <h4><?php echo $result["Name"]; ?></h4>
                  <div class="sb-meta">
                     <p class="meta-item text-muted">Rank: <?php echo ++$index; ?></p>
                     <p class="meta-item type text-center text-muted">
                        <?php switch($result["Status"])
                        {
                           case $result["Status"] == 'Solved':
                              echo '<span class="text-uppercase text-success">'.$result["Status"].'</span>';
                              break;
                           case $result["Status"] == 'Failed':
                              echo '<span class="text-uppercase text-danger">'.$result["Status"].'</span>';
                              break;
                           case $result["Status"] == 'Attempted':
                              echo '<span class="text-uppercase" style="color: #eb9316;">'.$result["Status"].'</span>';
                              break;
                           default:
                              echo '<span class="text-uppercase text-muted">Not Assigned</span>';
                        }
                        ?>
                     </p>
                  </div>
                  </div>
                  <div class="stats-container col-md-8 col-lg-8 col-sm-8">
                     <ul class="list-inline stat-list text-right">
                        <li class="solve-time text-center">
                           <span class="text-uppercase">Solved In</span>
                           <?php echo $result["solvedIn"];  ?>
                           <span class="text-uppercase">Minutes</span>
                        </li>
                        <li class="compile-time text-center">
                           <span class="text-uppercase">Compile Time</span>
                           <?php echo $result["Time"];  ?>
                           <span class="text-uppercase">seconds</span>
                        </li>
                        <li class="memory-time text-center">
                           <span class="text-uppercase">Consumed</span>
                           <?php echo $result["Memory"];  ?>
                           <span class="text-uppercase">memory</span>
                        </li>
                     </ul>
                  </div>
               </div>
            <?php endforeach; ?>
         <?php endif; ?>
      </div>
				<?php endif;?>


<?php endif; ?>


<?php
include '../../views/template_footer.php';
?>
