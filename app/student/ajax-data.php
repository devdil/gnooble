<?php
session_start();

	// Connect to database
	if (isset($_POST['secureId']) && !empty($_POST['secureId']))
	{
			if($_POST['secureId'] === 'gnooble2015')
			{
				$_SESSION['allow']= "true";
				echo "true";
				exit();
			}
		else {
			$_SESSION['allow'] = "false";
			echo "false";
			exit();
		}

	}
else
	echo json_encode("LOL!!!! :");
?>