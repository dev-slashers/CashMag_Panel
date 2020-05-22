<html dir="ltr"><head>
        <?php
        include 'lib/database.php';
        if($_COOKIE["admin_user"] != $admin_user && $_COOKIE["admin_pass"] != $admin_pass) header("Location: login.php"); ?>
    <script type="text/javascript">

        function Pass_Generator()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for( var i=0; i < 50; i++ )  text += possible.charAt(Math.floor(Math.random() * possible.length));
            document.getElementById("Pass_Text").value = text.substring(0,10); 
        }

        function Edit(id,email,credit)
        {
            document.getElementById("Email").value = email;
            document.getElementById("send").value = "Aggiungi Crediti";
        }

        function Reset()
        {
            document.getElementById("send").value = "Crea Utente";
        }


        function Page(N)
        {
          document.location = "admin.php?page=" + N;
        }

        function Refresh(Pages)
        {
            document.location.replace("admin.php?page=" + Pages); 
        }

       function Delete(ID,Email,Pages) 
        {
          if (confirm("Sicuro di volere eliminare " + Email + " ?")) 
          {
            document.location = "admin.php?delete=" + ID + "&page=" + Pages;
          }
        }

    </script>


    <?php

        if(isset($_GET['logout']))
        {
            setcookie('admin_user','');
            setcookie('admin_pass','');
            header(('Location: admin.php'));
        }

        if(isset($_POST["send"]))
        {
            $db = new Database();
            $Email      = isset($_POST["Email"]) ? htmlentities($_POST["Email"]) : "";
            $Password   = isset($_POST["Email"]) ? htmlentities($_POST["Pass"]) :"";

            if($_POST["send"] == "Aggiungi Crediti")
            {
                $db->Update_account($_POST["Email"], $_POST["Crediti"]);
                echo '<script>alert("Aggiornamento eseguito");</script>';
            }else
            {
                if($db->isValidEmail($Email) && strlen($Password) >= 4)
                {
                    if($db->Add_Account($Email,$Password,$_POST["Crediti"]))
                    {
                        $db->Send_Account($Email,$Password,$_POST["Crediti"]);
                        echo '<script>alert("Account creato !");</script>';
                    }else
                    {
                        echo '<script>alert("Username già esistente")</script>';
                    }

                }else
                {
                    echo '<script>alert("Dati non validi");</script>';
                }
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
        <a href="admin.php" class="active">Amministrazione</a></li>
        <li><a href="admin.php?logout">Esci</a></li>
        </ul> 
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
            <h3 class="t">Permessi</h3>
        </div>
        <div class="art-blockcontent">
            <form method="post" action="admin.php">
                <?php
                    $database = new Database();
                    $admin_setting =  $database->Return_Setting();
                    $reset_setting =  $admin_setting["Reset_Enabled"] ==  '1' ? 'checked="checked"' : '';
                    $delete_setting = $admin_setting["Delete_Enabled"] == '1' ? 'checked="checked"' : '';
                    $create_setting = $admin_setting["Create_Enabled"] == '1' ? 'checked="checked"' : '';
                ?>
                <input name="Reset_Setting" type="checkbox" <?php echo $reset_setting; ?>/> Reset utenti <br>
                <input name="Delete_Setting" type="checkbox" <?php echo $delete_setting; ?> /> Elimina utenti <br>
                <input name="Create_User" type="checkbox" <?php echo $create_setting; ?> /> Creazione utenti <br><br>
                <input type="submit" name="setting" style="float: right;" value="Salva" />
            </form>


        </div></div>


        <div class="art-block clearfix">
        <div class="art-blockheader">
            <h3 class="t">Gestione</h3>
        </div>
        <div class="art-blockcontent">
            <form method="post" action="admin.php">
                <input type="text" name="SearchEmail" placeholder="Ricerca Email" />
            </form>
            <br><br>
            <form method="post" action="admin.php">
                <input  type="text" id="Email" name="Email" placeholder="Email Utente" size="22" />
                <input  type="password" id="Pass_Text" name="Pass" placeholder="Password utente"  />
                <select name="Crediti">
                        <?php
                            for($i = 1; $i <= 50; $i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.' Crediti</option>';
                                }
                        ?>
                </select>
                <input type="button" onclick="Pass_Generator()" value="Genera Pass"/> 
                <input type="button" onclick="Reset()" value="Reset" /> <br> <br>
                <input type="submit" style="float: right;" id="send" value="Crea Utente" name="send" /> <br>
                
            </form>
        </div>
</div></div>


                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">                                               
                                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
                                <div class="art-content-layout-row">
                                <div class="art-layout-cell layout-item-0" style="width: 100%" >

                         <table style="width:100%;">
                          <tr>
                            <th>Username</th>
                            <th>Numero Crediti</th>
                            <th>Data Creazione</th>
                            <th>Aggingi Crediti</th>
                            <th>Elimina</th>
                          </tr>


                        <?php
                            $Count_Query = 0;
                            $Pagina = isset($_GET["page"]) && $database->isValidPage($_GET["page"]) ? $_GET["page"] : 0;
                            
                            if(isset($_POST["SearchEmail"]) && $database->isValidSearch($_POST["SearchEmail"]))
                            {
                                $result = $mysqli->query("select * From Account where Email LIKE '%".$_POST["SearchEmail"]."%';", MYSQLI_USE_RESULT);
                            }else
                            {
                                $result = $mysqli->query("SELECT * FROM Account ORDER BY id DESC LIMIT ".($Pagina * 20).",20;",MYSQLI_USE_RESULT);
                            }
                            
                            while($row = $result->fetch_assoc())
                            {

                                $Username          =   "javascript:var Key = prompt('Email','".$row["Email"]."');";
                                $Edit_Account      =   "javascript:Edit('".$row["id"]."','".$row["Email"]."','".$row["Crediti"]."');";
                                $Delete_Account    =   "javascript:Delete('".$row["id"]."','".$row["Email"]."','".$Pagina."');";
                                $Count_Query      +=    1;

                                echo '
                                <tr>
                                    <th><a href="'.$Username.'">'.$row["Username"].'</a></th>
                                    <th>'.$row["Crediti"].'</th>
                                    <th>'.$row["Data_Reg"].'</th>
                                    <th><a href="'.$Edit_Account.'"><img src="images/edit.png" width="16" height="16" /></a></th>
                                    <th><a href="'.$Delete_Account.'"><img src="images/delete.gif" width="16" height="16" /></a></th>
                                </tr>
                                ';
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
    $db = new Database();
    if($_COOKIE["admin_user"] == $admin_user && $_COOKIE["admin_pass"] == $admin_pass)
    {
        if(isset($_GET["status"]) && isset($_GET["id"]))
        {
            $db->Update_Stato($_GET["id"],$_GET["status"]);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
        if(isset($_GET["delete"]) && $db->isValidPage($_GET["delete"]))
        {
            $db->Delete_Account($_GET["delete"]);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
        if(isset($_POST["setting"])) 
        {
            $db->Save_Setting($_POST["Reset_Setting"],$_POST["Delete_Setting"],$_POST["Create_User"]);
            echo '<script> Refresh('.$Pagina.'); </script>';
        }
    }
?>

</body></html>

</html>