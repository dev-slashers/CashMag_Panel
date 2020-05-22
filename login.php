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
    <ul class="art-hmenu"><li><a href="index.php" >Home</a></li><li><a href="contatti.php" >Contatti</a></li><li><a href="install.php" >Guida</a></li><li><a href="<?php echo $telegram_link; ?>" target="_blank">Telegram</a></li><li><a href="admin.php" class="active">Amministrazione</a></li></ul> 
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
                header(('Location: login.php'));
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
                <form method="post" action="login.php">
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
                
                                                
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >

    		<?php
				$cookie_user = isset($_COOKIE["admin_user"]) ? $_COOKIE["admin_user"] : "";
				$cookie_pass = isset($_COOKIE["admin_pass"]) ? $_COOKIE["admin_pass"] : "";

				if($cookie_user == $admin_user && $cookie_pass == $admin_pass)
				{
					echo '<h3>Sei già Connesso.<br><a href="admin.php">Pannello</a> - <a href="?logout">Esci</a></h3>';
				}else
				{
					echo '
						<form method="post" action="login.php">
							<input type="text" name="user" placeholder="Username" /><br>
							<input type="password" name="pass" placeholder="password"> <br>
							<input type="submit" name="login" value="Entra" />
						</form>';
						}

			        if(isset($_GET['logout']))
			        {
			            setcookie('admin_user','Guest');
			            setcookie('admin_pass','');
			            header(('Location: login.php'));
			        }

					if(isset($_POST["login"]))
					{
						$username = isset($_POST["user"]) ? htmlentities($_POST["user"]) : "";
						$password = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : "";
						if($username == $admin_user && md5($password) == $admin_pass)
						{
							setcookie("admin_user",$username);
							setcookie("admin_pass",md5($password));
							header("Location: admin.php");
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

