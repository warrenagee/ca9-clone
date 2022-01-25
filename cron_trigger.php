<?

require_once ("/home/ca9admin/cms/static-site/dynamodb/common/rds_config.php");
$sql = "select opinions, memoranda, streaming from hugo_trigger where id='1' and (opinions > '' or memoranda >'' or streaming >'')";
$mysqli_result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


if ($mysqli_result) {

	$update_git = "";

	While ($row = $mysqli_result->fetch_row()) {
 
		if($row[0] == "waiting"){

                	$sql2 = "update hugo_trigger set opinions=''";
                	$mysqli_result2 = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
			
                        exec("php /home/ca9admin/cms/static-site/dynamodb/opinions/refresh_opinions_web_page.php");			
			$update_git = 1;

		}	


		if($row[1] == "waiting"){

			$sql2 = "update hugo_trigger set memoranda=''";
                	$mysqli_result2 = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));

			
			exec("php /home/ca9admin/cms/static-site/dynamodb/memoranda/refresh_memoranda_web_page.php");
                        $update_git = 1;
		}

                if($row[2] == "waiting"){

                        $sql2 = "update hugo_trigger set streaming=''";
                        $mysqli_result2 = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));


                        exec("php /home/ca9admin/cms/static-site/dynamodb/media/refresh_media_streaming.php");
                        $update_git = 1;

		}


	}


}

