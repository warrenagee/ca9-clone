<?

$table = $argv[1];
$action = $argv[2]; 
$pkid = ltrim($argv[3], "0"); 


if($table != "streaming"){

	$update_ddb = "php /home/ca9admin/cms/static-site/dynamodb/common/functions.php $table $action $pkid";
	exec("$update_ddb");
}


if($table == "bap"){

    $refresh_dynamodb = "php /home/ca9admin/cms/static-site/dynamodb/bap/refresh_bap_dynamodb.php";
    exec("$refresh_dynamodb");

    $refresh_web = "php /home/ca9admin/cms/static-site/dynamodb/bap/refresh_bap_web_page.php";
    exec("$refresh_web");

}else{

  require_once ("/home/ca9admin/cms/static-site/dynamodb/common/rds_config.php");

  $sql = "update hugo_trigger set ".$table." = 'waiting' where id='1'";

  $mysqli_result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

}


