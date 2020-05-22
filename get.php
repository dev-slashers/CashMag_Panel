<?php
	include 'lib/database.php';
	$db = new Database();

	function get_key($token) 
	{
		global $mysqli;
		$arr = Array();
		$key = null;
		$result = $mysqli->query("select * from User;", MYSQLI_USE_RESULT);
		while($row = $result->fetch_assoc())
		{
			if(md5($row["Licenza"]) == $token && $row["Abilitato"] == "True")
			{
				$key 					=  base64_encode($row["Download_Key"]);
				$arr["Licenza"] 		= $row["Licenza"];
				$arr["Download_Key"] 	= $row["Download_Key"];
				$arr["Email"]			= $row["Email"];
				$arr["id"] 				= $row["id"];
				$arr["Owner"]			= $row["Founder"];
				break;
			}
		}
		$result->close();

		$arr["Access_Key"] = strtolower(substr($key, 10,30));
		return json_encode($arr);
	}

	function get_workstation($token)
	{
		global $mysqli;
		$workstation = null;
		$result = $mysqli->query("select * from User;", MYSQLI_USE_RESULT);
		while ($row = $result->fetch_assoc()) 
		{
			if(md5($row["Licenza"]) == $token)
			{
				$workstation = $row["Workstation"];
				break;
			}
		}
		$result->close();
		return $workstation;
	}


	$token 		= 	isset($_GET["token"]) ? $_GET["token"] : null;
	$result 	= 	json_decode(get_key($token),true);
	
	if(isset($result["Access_Key"]) && isset($result["Licenza"]))
	{
		$workstation = get_workstation($token);
		if(isset($_GET["workstation"]) && isset($_GET["pcuser"]))
		{
			$user = $_GET["workstation"].":".$_GET["pcuser"];
			if($user == $workstation || $workstation == "-") echo get_key($token);
			if ($workstation == "-") $db->Update_Workstation($result["id"],$user);
			
		}
	}else
	{
		echo 'Non sei autorizzato a visualizzare questo pagina. Prego ritorna alla <a href="index.php">Home</a>';
	}
?>