<html dir="ltr"><head>
    <?php 
        include 'lib/database.php';
        $Count_Query = 0;
        $database = new Database();

        $cookie_user = isset($_COOKIE["resel_user"]) ? $_COOKIE["resel_user"] : null;
        $cookie_pass = isset($_COOKIE["resel_pass"]) ? $_COOKIE["resel_pass"] : null;
        if(!$database->Login_Account($cookie_user,$cookie_pass)) header("Location: index.php");
        $Profile = explode("(", $database->Account_Profile($cookie_user))[0];
        $Pagina = isset($_GET["page"]) && $database->isValidPage($_GET["page"]) ? $_GET["page"] : 0;

        $enable_reset = $database->Return_Setting()["Reset_Enabled"];
        $enable_delete = $database->Return_Setting()["Delete_Enabled"];
        $enable_user  = $database->Return_Setting()["Create_Enabled"];
                            
    ?>

        <script type="text/javascript">

        function Licenza_Random()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for( var i=0; i < 50; i++ )  text += possible.charAt(Math.floor(Math.random() * possible.length));
            text = text.toUpperCase();
            document.getElementById("Generatore_Licenza").value = text.substring(0,4) + "-" + text.substring(5,9) + "-" + text.substring(10,4) + "-" + text.substring(15,19); 
        }

        function Page(N)
        {
          document.location = "manager.php?page=" + N;
        }

        function Refresh(Pages)
        {
            document.location.replace("manager.php?page=" + Pages); 
        }

       function Delete(ID,Email,Pages) 
        {
          if (confirm("Sicuro di volere eliminare " + Email + " ?")) 
          {
            document.location = "manager.php?delete=" + ID + "&page=" + Pages;
          }
        }

        function Reset(ID,Pages)
        {
            document.location = "manager.php?reset=" + ID + "&page=" + Pages;
        }

    </script>

        <?php
        if(isset($_POST["send"]))
        {
            $Key        =   $database->Download_Key_String();
            $Email      =   isset($_POST["Email"]) ? htmlentities($_POST["Email"]) : "";
            $Licenza    =   isset($_POST["Licenza"]) ? htmlentities($_POST["Licenza"]) : "";

            if($database->isValidEmail($Email) && strlen($Licenza) > 8 && strpos($Licenza, ":") == null)
            {
                if($database->Check_Making($cookie_user))
                {
                    if($enable_user == "1")
                    {
                        $database->Add_User($Email,$Licenza,"True",$Key,$Profile);
                        $database->Set_Credit($cookie_user,"--");
                        $database->Send_User($Email,$Licenza,$Key,$cookie_user);  
                        echo "<script>alert('Licenza creata');</script>";
                    }else
                    {
                        echo "<script>alert('Non è possibile creare nuove licenze');</script>";
                    }
                }else
                {
                    echo "<script>alert('Crediti esauriti');</script>";
                }
            }else
            {
                echo "<script>alert('Controllare i campi');</script>";
            }
        }

        if(isset($_POST["change_pwd"]))
        {
            $old_pwd = isset($_POST["old_pwd"]) ? htmlentities($_POST["old_pwd"]) : "";
            $new_pwd = isset($_POST["new_pwd"]) ? htmlentities($_POST["new_pwd"]) : "";
            if(!$database->Change_Account_Password($old_pwd,$new_pwd,$cookie_user)) 
            {
                echo '<script>alert("Errore: Ricorda la password deve contenere almeno 4 caratteri.");</script>';
            }else
            {
                header("location: index.php");
            }
        }
    ?>

    <meta charset="utf-8">
    <title><?php echo $site_title; ?></title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="css/style.responsive.css" media="all">


    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script.responsive.js"></script>
<meta name="description" content="Description">
<meta name="keywords" content="Keywords">



<style>.art-content .art-postcontent-0 .layout-item-0 { padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style></head>
<body>
<div id="art-main">
<header class="art-header clearfix">


    <div class="art-shapes">
<h1 class="art-headline" data-left="1.09%">
    <a href="#">CashMag</a>
</h1>
<h2 class="art-slogan" data-left="1.09%">Gestionale per la tua attività</h2>

<div class="art-object0" data-left="99.8%"></div>
<div class="art-textblock art-object554312304" data-left="0%">
        <div class="art-object554312304-text"></div>
    
</div>
            </div>

<nav class="art-nav clearfix">
    <div class="art-nav-inner">
    <ul class="art-hmenu"><li><a href="index.php">Home</a></li><li><a href="contatti.php" >Contatti</a></li><li>
        <a href="install.php">Guida</a></li><li><a href="<?php echo $telegram_link; ?>" target="_blank">Telegram</a></li><li>
        <a href="admin.php">Amministrazione</a></li><li>
        <a href="manager.php" class="active" >
            <?php
                echo $database->Account_Profile($_COOKIE["resel_user"]);
            ?>

        </a></li></ul> 
        </div>
    </nav>



</header>
<div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1 clearfix">
                            <div class="art-block clearfix">
                                <div class="art-blockheader">
                                    <h3 class="t">Gestione Utenti</h3>
                                </div>
                                <div class="art-blockcontent">
                        <form method="post" action="manager.php">
                            <input type="text" name="SearchEmail" placeholder="Ricerca Email" />
                        </form>
                        <br>
                        <form method="post" action="manager.php">
                            <input  type="text" name="Email" placeholder="Email Utente" />
                            <input  type="text" name="Licenza" id="Generatore_Licenza" placeholder="Licenza Utente"  /> <br><br>
                            <input type="button" onclick="Licenza_Random()" value="Genera Licenza"/>
                            <input type="submit" value="Invia" name="send" /> 
                        </form>
        </div>
</div><div class="art-block clearfix">
        <div class="art-blockheader">
            <h3 class="t">Impostazioni</h3>
        </div>
        <div class="art-blockcontent">
            <form method="post" action="manager.php">
                <input type="password" name="old_pwd" placeholder="Password Corrente" />
                <input type="password" name="new_pwd" placeholder="Nuova Password" />
                <nobr>
                <input type="submit" name="change_pwd" value="cambia" /> 
            </form>

            </nobr>  
        </div>
</div></div>
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                
                                                
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
            

                         <table style="width:100%;">
                          <tr>
                            <th>Email</th>
                            <th>Licenza</th> 
                            <th>Accesso</th>
                            <th>Download</th>
                            <th>Stato</th>
                            <?php 
                                if ($enable_reset == "1") echo '<th>Reset</th>';
                                if ($enable_delete == "1") echo '<th>Elimina</th>';
                            ?> 
                            
                            
                          </tr>


                        <?php
                            
                            if(isset($_POST["SearchEmail"]) && $database->isValidSearch($_POST["SearchEmail"]))
                            {
                                $result = $mysqli->query("select * From User where Email LIKE '%".$_POST["SearchEmail"]."%' and Founder = '".$Profile."';", MYSQLI_USE_RESULT);
                            }else
                            {
                                $result = $mysqli->query("SELECT * FROM User WHERE Founder = '".$Profile."' ORDER BY id DESC LIMIT ".($Pagina * 20).",20;",MYSQLI_USE_RESULT);
                            }
                            
                            while($row = $result->fetch_assoc())
                            {
                                if($Profile == $row["Founder"])
                                {
                                    $Email             =   "javascript:var Key = prompt('Email','".$row["Email"]."');";
                                    $Licenza_prompt    =   "javascript:var Key = prompt('Licenza','".htmlentities($row["Licenza"])."');";
                                    $Licenza_String    =   explode("-",htmlentities($row["Licenza"]));
                                    $Stato_img         =   $row["Abilitato"] == "True" ? "enable.png" : "disable.png";
                                    $Data              =   $row["Ultimo_Accesso"] == date('m/d/Y', time()) ? "Oggi" : $row["Ultimo_Accesso"];
                                    $Data_prompt       =   $row["Workstation"] == "-" ? "#" : "javascript:var Key = prompt('User','".$row["Workstation"]."');";
                                    $Stato_link        =   "manager.php?id=".$row["id"]."&status=".$row["Abilitato"]."&page=".$Pagina;
                                    $download_link     =   "download.php?id=".$row["Download_Key"];
                                    $Delete_User       =   "javascript:Delete('".$row["id"]."','".$row["Email"]."','".$Pagina."');";
                                    $Reset_User        =   "javascript:Reset('".$row["id"]."','".$Pagina."');";
                                    $Count_Query      +=    1;
                                    echo '<tr>
                                        <th><a href="'.$Email.'">'.explode("@", $row["Email"])[0].'</a></th>
                                        <th><a href="'.$Licenza_prompt.'">'.$Licenza_String[0].'-****-****-'.$Licenza_String[3].'</a></th>
                                        <th><a href="'.$Data_prompt.'">'.$Data.'</a></th>
                                        <th><a href="'.$download_link.'"><img src="images/download_soft.png" /></a></th>
                                        <th><a href="'.$Stato_link.'"><img src="images/'.$Stato_img.'" width="16" height="16"  /></a></th>';
                                        if ($enable_reset == "1") echo '<th><a href="'.$Reset_User.'"><img src="images/reset.png" width="16" height="16" /></a></th>';
                                        if ($enable_delete == "1") echo '<th><a href="'.$Delete_User.'"><img src="images/delete.gif" width="16" height="16" /></a></th>';
                                    echo '</tr>';
                                }
                            }

                        ?>

                        </table>
    </div>
    </div>
</div>
</div>

</article></div>
                    </div>
                </div>
            </div>
    </div>
<footer class="art-footer clearfix">
  <div class="art-footer-inner">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 50%">
        <p style="float: left; padding-left: 20px; text-align: left;">
            <div style="position:absolute; top:0;right: 40;">
                <?php
                    if($Pagina != 0)       echo '<input type="button" onclick="javascript:Page('.($Pagina - 1).')" value="< Indietro" />';
                    if($Count_Query == 20) echo '<input type="button" onclick="javascript:Page('.($Pagina + 1).')" value="Avanti >" />';
                ?>             

            <div>
        </p>
    </div><div class="art-layout-cell layout-item-0" style="width: 50%">
        <p><br></p>
    </div>
    </div>
</div>

  </div>
</footer>

</div>


<?php
    if($database->Login_Account($cookie_user,$cookie_pass))
    {
        if(isset($_GET["status"]) && isset($_GET["id"]))
        {
            $database->Update_Stato($_GET["id"],$_GET["status"]);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
        if(isset($_GET["delete"]) && $enable_delete == "1" && $database->isValidPage($_GET["delete"]))
        {
            $database->Delete_User($cookie_user,$_GET["delete"]);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
        if(isset($_GET["reset"]) && $enable_reset == "1")
        {
            $database->Reset_User($_GET["reset"],$cookie_user);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
    }
?>

</body></html>