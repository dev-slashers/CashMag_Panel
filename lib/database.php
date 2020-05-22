<?php
	include 'config.php';
	class Database
	{
		
		function Add_User($email,$licenza,$Abilitato,$Download_Key,$Profile)
		{
			global $mysqli;
			$query = sprintf("INSERT INTO User (Founder,Email, Licenza, Abilitato, Download_Key, Ultimo_Accesso, Workstation) VALUES ('%s','%s', '%s', '%s', '%s','%s','%s')", $Profile,$email, $licenza,$Abilitato,$Download_Key,"-","-");
			$mysqli->query($query);
		}


		function Return_Setting()
		{
			global $mysqli;
			$json_return = Array();
			$result = $mysqli->query("select * from Setting where id = '1';", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				$json_return["Reset_Enabled"]  = $row["Reset_Enabled"];
				$json_return["Delete_Enabled"] = $row["Delete_Enabled"];
				$json_return["Create_Enabled"] = $row["Create_Enabled"];
			}
			$result->close();

			return $json_return;
		}

		function Save_Setting($reset,$delete,$create)
		{
			global $mysqli;
			$reset_setting =  $reset ==  "on" ? '1':'0';
			$delete_setting = $delete == "on" ? '1':'0';
			$create_setting = $create == "on" ? '1':'0';
			$mysqli->query("UPDATE Setting set Reset_Enabled = '".$reset_setting."', Delete_Enabled = '".$delete_setting."', Create_Enabled = '".$create_setting."' WHERE id = '1';");
		}

		function Add_Account($email,$password,$crediti)
		{
			global $mysqli;
			$check_mail = true;
			$Data = date('m/d/Y', time());
			$User = explode("@", $email);
			$result = $mysqli->query("select * from Account;", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				if($row["Username"] == $User[0])
				{
					$check_mail = false;
					break;
				}
			}
			$result->close();

			if($check_mail)
			{
				$query = sprintf("INSERT INTO Account (Email,Username,Password,Crediti,Data_Reg) VALUES ('%s','%s','%s','%s','%s')", $email,$User[0],md5($password),$crediti,$Data);
				$mysqli->query($query);
			}

			return $check_mail;
		}

		function Change_Account_Password($Old_Pass,$New_pass,$Username)
		{
			global $mysqli;
			$Action = false;
			$db_id 	= null;
			$result = $mysqli->query("select * from Account;", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				if($Username == $row["Username"] && md5($Old_Pass) == $row["Password"] && strlen($New_pass) >= 4)
				{
					$Action = true;
					$db_id = $row["id"];
					break;
				}
			}
			$result->close();

			if($Action) $mysqli->query("update Account set Password = '".md5($New_pass)."' WHERE id = '".$db_id."';");
			return $Action;
		}

		function Delete_User($founder,$id)
		{
			global $mysqli;
			$db_resel = null;
			$result = $mysqli->query("select * from User WHERE id = '".$id."';", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				$db_resel = $row["Founder"];
			}
			$result->close();

			if($db_resel == $founder) $mysqli->query("DELETE FROM User WHERE id=".$id.";", MYSQLI_USE_RESULT);
		}

		function Delete_Account($id)
		{
			global $mysqli;
			$mysqli->query("DELETE FROM Account WHERE id = ".$id.";");
		}

		function Update_Stato($id,$stato)
		{
			global $mysqli;
			$new_stato = $stato == "True" ? "False" : "True";
			$mysqli->query("UPDATE User SET Abilitato = '".$new_stato."' Where id = '".$id."';", MYSQLI_USE_RESULT);
		}

		function Reset_User($id,$Founder)
		{
			global $mysqli;
			$reset = false;
			$result = $mysqli->query("select * from User where id = '".$id."';", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				if($row["Founder"] == $Founder) $reset = true;
			}
			$result->close();

			if($reset == true) $mysqli->query("update User set Workstation = '-' WHERE id = '".$id."';",MYSQLI_USE_RESULT);
		}

		function Update_Workstation($id,$workstation)
		{
			global $mysqli;
			$mysqli->query("update User set Ultimo_Accesso = '".date('m/d/Y', time())."', Workstation = '".$workstation."' where id = '".$id."';",MYSQLI_USE_RESULT);
		}

		function Check_Making($Username)
		{
			global $mysqli;
			$Credit = null;
			$result = $mysqli->query("select * from Account WHERE Username = '".$Username."';", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				$Credit = $row["Crediti"];	
			}
			$result->close();

			if($Credit == "0") return false;
			return true;
		}

		function Set_Credit($Username,$Operator)
		{
			global $mysqli;
			$db_id		=	null;
			$Credito 	= 	null;
			$result = $mysqli->query("select * from Account where Username = '".$Username."';", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				$db_id   = $row["id"];
				$Credito = $row["Crediti"];	
			}
			$result->close();

			if($Credito != "0")
			{
				if($Operator == "++")
				{
					$Credito += 1; 
				}else if($Operator == "--")
				{
					$Credito = $Credito == "1" ? "0" : ($Credito - 1);
				}

				if($db_id != null) $mysqli->query("UPDATE Account set Crediti = '".$Credito."' where id = '".$db_id."';",MYSQLI_USE_RESULT);
			}

		}

		function Login_Account($Username,$Password)
		{
			global $mysqli;
			$result = $mysqli->query("select * from Account;", MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				if($row["Username"] == $Username && $Password == $row["Password"])
				{
                	return true;
                	break;
				}	
			}
			$result->close();
			return false;
		}

		function Update_account($Email,$crediti)
		{
			global $mysqli;
			$db_id 		 = null;
			$db_email	 = null;
			$db_Username = null;
			$db_Crediti  = null;
	
			
			$result = $mysqli->query("select * from Account;", MYSQLI_USE_RESULT);
			while($row = $result->fetch_assoc())
			{
				if($Email == $row["Email"])
				{
					$db_id = $row["id"];
					$db_email = $row["Email"];
					$db_Username = $row["Username"];
					$db_Crediti = ($row["Crediti"] + $crediti);
					break;
				}
			}
			$result->close();

			if($db_Username != null && $db_Crediti != null && $db_id != null)
			{
				$mysqli->query("update Account set Email = '".$db_email."', Crediti = '".$db_Crediti."', Username = '".$db_Username."' where id = '".$db_id."';");
			}
		}

		function Account_Profile($Username)
		{
			global $mysqli;
			$db_Username = null;
			$db_Credit   = null;

			$result = $mysqli->query("select * from Account;", MYSQLI_USE_RESULT);
			while($row = $result->fetch_assoc())
			{
				if($Username == $row["Username"])
				{
					$db_Username = $row["Username"];
					$db_Credit = $row["Crediti"];
					break;
				}
			}
			$result->close();
			return $db_Username."(".$db_Credit.")";
		}

		function Download_Key_String($length = 30) 
		{
    		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
		}

		function Send_User($Email,$Licenza,$download_key,$founder)
		{
			global $mysqli,$site_path,$download_guida;
			$Resel_mail = null;
			$User = explode("@", $Email);
			$result = $mysqli->query("select * from Account where Username = '".$founder."';",MYSQLI_USE_RESULT);
			while ($row = $result->fetch_assoc()) 
			{
				$Resel_mail = $row["Email"];
			}
			$result->close();

			$Text = "Ciao ".$User[0]."!\n\n\tLicenza:  ".$Licenza."\n\n\tDownload: ".$site_path."download.php?id=".$download_key."
			\n\tGuida:    ".$download_guida." \n
			\n\n\n-  CashMag Team -";
			
			if($Resel_mail != null) mail($Email, "[CashMag] Licenza Software", $Text, "From:".$Resel_mail);
		}

		function Send_Account($Email,$Password,$Crediti)
		{
			global $admin_mail,$site_path;
			$User = explode("@", $Email);
			$Text = "Ciao ".$User[0]." !\n\nDi Seguito le tue credenziali:\n\n\nUsername: ".$User[0]."\nPassword: ".$Password.
			"\nCrediti: ".$Crediti."\nLogin:".$site_path."\n\nCordiali Saluti\n\n\n-  CashMag Team -";
			mail($Email, "[CashMag] Account Rivenditore", $Text,"From:".$admin_mail);
		}

		function Contatti($Email,$Nome,$Messaggio)
		{
			global $admin_mail;
			$User = explode("@", $Email);
			mail($admin_mail, "[CashMag] Richiesta da ".$User[0], $Messaggio,"From:".$Email);
		}

		function isValidEmail($email)
		{
    		return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
		}
		function isValidSearch($input)
		{
			$input = str_replace("@", "",$input);
			$input = str_replace(".", "",$input);
			return preg_match("/^[a-zA-Z0-9]*$/", $input) && $input != "";
		}
		function isValidPage($page)
		{
			return preg_match("/^[0-9]*$/", $page) && $page > 0;
		}


		function Check_ID($id)
		{
			global $mysqli;
			$str = false;
			$result = $mysqli->query("select * from User;", MYSQLI_USE_RESULT);
			while($row = $result->fetch_assoc())
			{
				if($id == $row["Download_Key"])
				{
					$str = true;
				}
			}
			$result->close();

			return $str;
		}
	}
?>