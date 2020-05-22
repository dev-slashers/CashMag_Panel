<html dir="ltr"><head>
    <?php include 'lib/database.php'; ?>
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
    <ul class="art-hmenu"><li><a href="index.php" >Home</a></li><li><a href="contatti.php" class="active">Contatti</a></li><li><a href="install.php">Guida</a></li><li><a href="<?php echo $telegram_link; ?>" target="_blank">Telegram</a></li><li><a href="admin.php">Amministrazione</a></li></ul> 
        </div>
    </nav>


</header>
<div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1 clearfix"><div class="art-block clearfix">
        <div class="art-blockheader">
            <h3 class="t">Pannello</h3>
        </div>
        <div class="art-blockcontent">
        	<p>
        <?php

            $db = new Database();
            $cookie_user = isset($_COOKIE["resel_user"]) ? $_COOKIE["resel_user"] : null;
            $cookie_pass = isset($_COOKIE["resel_pass"]) ? $_COOKIE["resel_pass"] : null;

            if(isset($_GET['logout']))
            {
                setcookie('resel_user','');
                setcookie('resel_pass','');
                header(('Location: contatti.php'));
            }

            if(isset($_POST["login"]))
            {
                $Username = isset($_POST["user"]) ? htmlentities($_POST["user"]) : null;
                $Password = isset($_POST["pass"]) ? md5($_POST["pass"]) : null;
                if($db->Login_Account($Username,$Password))
                {
                    setcookie('resel_user',$Username);
                    setcookie('resel_pass',$Password);
                    header(('Location: manager.php'));
                }
            }

            if($db->Login_Account($cookie_user,$cookie_pass))
            {
                echo 'Sei già Connesso.<br><a href="manager.php">Pannello</a> - <a href="?logout">Esci</a>';
            }else
            {
                echo '
                <form method="post" action="contatti.php">
                    <input type="text" name="user" placeholder="Username" /><br>
                    <input type="password" name="pass" placeholder="password"> <br>
                    <input type="submit" name="login" value="Entra" />
                </form>';
            }
        ?>

        	</p>
        </div>
</div><div class="art-block clearfix">
        <div class="art-blockheader">
            <h3 class="t">Social</h3>
        </div>
        <div class="art-blockcontent"><p style="text-align: center;"><a href="#"><img width="50" height="50" alt="" src="images/facebook.png"></a> &nbsp;<a href="#"><img width="50" height="50" alt="" src="images/twitter.png"></a></p></div>
</div></div>
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                                <h2 class="art-postheader">Contattaci</h2>
                                                
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
            <form method="post" action="contatti.php">
                <input type="text" name="name" placeholder="Nome" />
                <input type="text" name="email" placeholder="Email" />
                <textarea name="Message" rows="4" cols="50"></textarea>
                <img src="images/captcha.php" /> <input type="text" size="22" name="captcha" placeholder="Captcha" /> <br>
                <input type="submit" value="Invia" name="send" />
            </form>
    <?php
        session_start();
        $db = new Database();
        if(isset($_POST["send"]) && $_POST["captcha"] == $_SESSION["captcha"])
        {
            if($db->isValidEmail($_POST["email"]) && strlen($_POST["Message"]) >= 5 && strlen($_POST["name"]) >= 2)
            {
                $db->Contatti($_POST["email"],$_POST["name"],$_POST["Message"]);
                echo "<script>alert('Messaggio Inviato');</script>";
            }else
            {
                echo "<script>alert('Ricontrollare i campi: Email\nMessaggio\nNome');</script>";
            }
        }
    ?>

    </div>
    </div>
</div>
</div>
                                
                </article></div>
                    </div>
                </div>
            </div>
    </div>

</div>


</body></html>

</html>

