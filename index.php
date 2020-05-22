<html dir="ltr"><head>
    <?php include 'lib/database.php'; ?>
    <meta charset="utf-8">
    <title><?php echo $site_title; ?></title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="css/style.responsive.css" media="all">


<script src="js/lightbox-plus-jquery.min.js"></script>
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
        <h1 class="art-headline" data-left="1.09%"><a href="#">CashMag</a></h1>
        <h2 class="art-slogan" data-left="1.09%">Gestionale Bar, Pub e Pizzeria</h2>
        <div class="art-object0" data-left="99.8%"></div>
        <div class="art-textblock art-object554312304" data-left="0%">
            <div class="art-object554312304-text"></div>
        
    </div>
</div>


<nav class="art-nav clearfix">
    <div class="art-nav-inner">
    <ul class="art-hmenu"><li><a href="index.php" class="active">Home</a></li><li><a href="contatti.php" >Contatti</a></li><li><a href="install.php">Guida</a></li><li><a href="<?php echo $telegram_link; ?>" target="_blank">Telegram</a></li><li><a href="admin.php">Amministrazione</a></li></ul> 
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
                header(('Location: index.php'));
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
                <form method="post" action="index.php">
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

        
        <center>
            <div>
                <a href="images/gallery/server_main.png" data-lightbox="example-set" data-title="Applicativo Server/PC, Gestione Tavoli e ordinazioni."><img class="example-image"   width="480" height="360" src="images/gallery/server_main.png" alt="" /></a>
                <a href="images/gallery/server_main_cassa.png" data-lightbox="example-set" data-title="Applicativo Server/PC, Gestione cassa e clienti."><img class="example-image" style="display: none;" src="images/gallery/server_main_cassa.png" alt="" /></a>
                <a href="images/gallery/server_history.png" data-lightbox="example-set" data-title="Applicativo Server/PC, Gestione storico ordini."><img class="example-image" style="display: none;" src="images/gallery/server_history.png" alt="" /></a>
                <a href="images/gallery/admin_setting.png" data-lightbox="example-set" data-title="Impostazioni amministratore."><img class="example-image" style="display: none;" src="images/gallery/admin_setting.png" alt="" /></a>
                <a href="images/gallery/ricevuta.png" data-lightbox="example-set" data-title="Esempio scontrino."><img class="example-image" style="display: none;" src="images/gallery/ricevuta.png" alt="" /></a>
                <a href="images/gallery/client.jpg" data-lightbox="example-set" data-title="Applicativo client su WinPad 7 W700"><img class="example-image" style="display: none;" src="images/gallery/client.jpg" alt="" /></a>
                <a href="images/gallery/installer.png" data-lightbox="example-set" data-title="Installer, configura l'applicativo per tablet e pc"><img class="example-image" style="display: none;" src="images/gallery/installer.png" alt="" /></a>
            </div>
            <link rel="stylesheet" href="css/lightbox.min.css">
            <i>Clicca Sull'immagine</i>
        </center>
                                                
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
    	<p>
            Cashmag è un software che semplifica la gestione e la vendita dei prodotti, ottimizzando i tempi di lavoro e favorendo quindi una crescita dell’attività. <br>
            Per l’utilizzo di Cashmag necessiti solo di due dispositivi:<br> un PC fisso o portatile con sistema operativo Windows, e un tablet Windows. <br>
            Il programma è provvisto di un catalogo di base contenente diversi prodotti, suddivisi per categorie, e i relativi prezzi. <br>
            È possibile aggiungere o rimuovere, in qualsiasi momento, le categorie dei prodotti, i prodotti presenti, e i relativi prezzi. <br>

        </p>
        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
        <h4>Come funziona in breve</h4>
        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
        <p>
          Questo gestionale è formato da due applicativi Windows, Client e Server, i quali sfruttano un database per la gestione dei dati. <br>
          In sostanza: <br>
          Il cameriere si reca al tavolo, segna l’ordine effettuato sul tablet e il tavolo da cui è stato effettuato. <br>
          L’addetto alla cassa, riceverà una notifica in cui visualizzerà l’ordine arrivato, il tavolo da cui è stato effettuato e i costi in dettaglio dell’ordine effettuato. <br>
          Il numero dei prodotti presenti viene aggiornato in tempo reale, dunque, è possibile verificare la presenza dei prodotti al momento dell’ordine dei clienti. <br>
          In più: <br>
          L’addetto alla cassa ha la possibilità di aggiornare la lista dei prodotti presenti, aggiungendo o rimuovendo la disponibilità di questi ultimi; il tablet verrà aggiornato automaticamente senza dover effettuare alcuna operazione. 
        </p>

        
        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
        <h4>Perché sceglierlo</h4>
        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
        <p>
            <li> User-friendly: interfaccia utente semplice, intuitiva e di facile utilizzo;
            <li> Affidabilità: i prodotti sono automaticamente aggiornati in tempo reale, ciò consente di sapere quali prodotti sono disponibili al momento per la vendita; <br>
            <li> Ottimizzazione tempi: il tempo è denaro, e questo è risaputo; con Cashmag sarai in grado di ridurre i tempi per la gestione e la vendita dei tuoi prodotti; <br>
            <li> Installazione semplificata: il download e l’installazione del programma sono ridotti a pochi click, il software inoltre è corredato di una semplice guida per tali procedure. <br>
        </p>

        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
            <h4>One More Thing</h4>
        <hr style="border:none;background-color:#b0b7c2;color:#b0b7c2;height:2px;" />
        Ancora una cosa... <br>
        Puoi richiedere una prova di 7 giorni senza alcun impegno <br>
        Contattaci usando il <a href="contatti.php">modulo apposita</a>.

        </p>
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

