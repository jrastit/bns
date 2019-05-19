<?php
	require_once "../inc/lang.inc";
	require_once "../inc/register.inc";
?>
<!DOCTYPE html>
<html lang="<?php echo $lng; ?>">

  <head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="<?php t('meta', 'description') ?>"/>
    <meta name="author" content="BNS"/>
		<meta property="og:title" content="BNS"/>
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="https://bns.aitivity.com/"/>
		<meta property="og:description" content="<?php t('meta', 'description') ?>"/>
		<meta property="og:image" content="http://img.securegg.com/logo_bns_200x200.png"/>
		<meta property="og:image:type" content="image/jpeg"/>
		<meta property="og:image:width" content="1339"/>
		<meta property="og:image:height" content="1225"/>
		<meta property="fb:app_id" content="385560598575015"/>
		
		<!-- favicon -->
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    <title>BNS</title>


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome/css/all.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- Solidity Ethereum script -->
    <script src="node_modules/web3/dist/web3.js"></script>
    <script src="solidity_script.js"></script>
    
    

  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top" style="color:#6D2E84;">
          <img src="/img/logo_bns_200x100.png" class="img-fluid" alt="BNS" style="height:2em;">
          <!-- Ai<span style="color:#998786;">tivity</span> -->
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
						<?php foreach($t['menu'] as $key=>$item){ ?> 
						<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo $key; ?>.php"><?php echo t("menu", $key);?></a>
            </li>
						<?php } ?>
						<li class="dropdown" style="padding-left:1em;">
            	<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
								<img id="imgNavSel" src="img/<?php echo $t['flag'][$lng]['img'] ?>" alt="..." class="img-thumbnail icon-small">
								<span id="lanNavSel">
									<?php echo substr ($t['flag'][$lng]['name'], 0, 3); ?>
								</span> <span class="caret">
								</span>
							</a>
              <ul class="dropdown-menu" role="menu" style="background-color:black;padding-left:1em;">
								<?php foreach($t['flag'] as $key=>$item){ ?>
            	  <li>
									<a href="?lang=<?php echo $key; ?>" class="language"> 
										<img src="img/<?php echo $item['img'] ?>" alt="..." class="img-thumbnail icon-small">&nbsp;&nbsp;
										<span><?php echo $item['name'] ?></span>
									</a></li>
								<?php } ?>
        	    </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<?php

$url=strtok($_SERVER["REQUEST_URI"],'?');

if (isset($_POST["register_keyword"]) && isset($_POST["register_host"]) && isset($_POST["register_stack"])){
?>
  <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <!-- <h1 class="brand-heading"><img src="/img/logo_bns_200x100.png" class="img-fluid" alt="BNS"></h1> -->
              <!-- <h1 class="brand-heading"><?php t('intro', 'tittle') ?></h1> -->
	            <p class="intro-text"><?php t('register', 'baseline') ?></p>
              <p data-meaningful="true"><?php t('register', 'description') ?></p>
              <p data-meaningful="true"><?php echo $_POST["register_stack"]." : ".$_POST["register_keyword"]." => ".$_POST["register_host"];?></p>
              <button class="btn btn-primary btn-sm" onclick="add_record('<?php echo $_POST["register_keyword"] . "', '".gethostbyname ($_POST["register_host"])."', '" .$_POST["register_host"]."', ".$_POST["register_stack"];?>);">Add record</button>
            </div>
          </div>
				</div>
      </div>
    </header>
<?php  
}else if ($url == "/register.php"){
?>
  <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <!-- <h1 class="brand-heading"><img src="/img/logo_bns_200x100.png" class="img-fluid" alt="BNS"></h1> -->
              <!-- <h1 class="brand-heading"><?php t('intro', 'tittle') ?></h1> -->
	            <p class="intro-text"><?php t('register', 'baseline') ?></p>
              <p data-meaningful="true"><?php t('register', 'description') ?></p>
              <!-- Search form -->
              <form action="register.php" method="post">
                <div class="input-group md-form form-sm form-1 pl-0">
                  <div class="input-group-prepend">
                    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                  </div>
                  <input class="form-control my-0 py-1" type="text" placeholder="Keyword" aria-label="Keyword" name="register_keyword">
                </div>
                  <br /><br />
                <div class="input-group md-form form-sm form-1 pl-0">
                  <div class="input-group-prepend">
                    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                  </div>
                  <input class="form-control my-0 py-1" type="text" placeholder="Host" aria-label="Host" name="register_host">
                </div>
                  <br /><br />
                <div class="input-group md-form form-sm form-1 pl-0">
                  <div class="input-group-prepend">
                    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                  </div>
                  <input class="form-control my-0 py-1" type="text" placeholder="Stack" aria-label="Stack" name="register_stack">
                </div>
                <br />
                <input type="submit" class="btn btn-primary btn-sm" value="Add">
              </form>
              <br />
              <br />
            </div>
          </div>
				</div>
      </div>
    </header>
<?php
}else if ($url == "/about.php"){
?>
  <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <!-- <h1 class="brand-heading"><img src="/img/logo_bns_200x100.png" class="img-fluid" alt="BNS"></h1> -->
              <!-- <h1 class="brand-heading"><?php t('intro', 'tittle') ?></h1> -->
	            <p class="intro-text"><?php t('about', 'baseline') ?></p>
              <p data-meaningful="true"><?php t('about', 'description') ?></p>
            </div>
          </div>
				</div>
      </div>
    </header>
<?php

}else if (isset($_POST["search_word"])){
?>
    <!--search Section -->
    <section id="search" class="content-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <!-- <h2><?php t('search', 'headline'); ?></h2> -->
              <form action="index.php" method="post">
                <div class="input-group md-form form-sm form-1 pl-0" style="margin-top:2em;">
                  <div class="input-group-prepend">
                    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                  </div>
                  <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" name="search_word" value="<?php echo $_POST["search_word"];?>">
                </div>
                <br />
                <input type="submit" class="btn btn-primary btn-sm" value="search">
                <br />
                <br />
              </form>
              
              <!--<button class="btn btn-primary btn-sm" onclick="get_ip_stack('<?php echo $_POST["search_word"];?>');">Get IP</button>-->
          </div>
        </div>  
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <!-- <h2><?php t('search', 'headline'); ?></h2> -->
            <div class="row">
       			  <div class="col-xs-12 col-sm-12 mx-auto justify-content-center align-self-center"  style="margin-bottom:1em" id="search_result">
				        <p class="text-justify lead" data-meaningful="true">Loading</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php
}else{
?>

    <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h1 class="brand-heading"><img src="/img/logo_bns_200x100.png" class="img-fluid" alt="BNS"></h1>
              <!-- <h1 class="brand-heading"><?php t('intro', 'tittle') ?></h1> -->
	            <p class="intro-text"><?php t('intro', 'baseline') ?></p>
              <p data-meaningful="true"><?php t('intro', 'description') ?></p>
              <!-- Search form -->
              <form action="index.php" method="post">
                <div class="input-group md-form form-sm form-1 pl-0">
                  <div class="input-group-prepend">
                    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                  </div>
                  <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" name="search_word">
                </div>
                <br />
                <input type="submit" class="btn btn-primary btn-sm" value="search">
              </form>
              <br />
              <br />
            </div>
          </div>
				</div>
      </div>
    </header>

<?php
}
?>

    <!-- Footer -->
    <footer>
      <div class="container text-center">
        <p>ETHNewYork BNS project</p>
      </div>
      <div class="container text-center">
        <p>Copyright &copy; Open!</p>
      </div>
    </footer>

		<!-- Cookies -->
		<div class="alert alert-dismissible text-center cookiealert show" role="alert">
    	<div class="cookiealert-container">
				<p><?php t('cookies', 'advise'); ?>

        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
					<?php t('cookies', 'ok'); ?>
        </button>
				</p>
    	</div>
		</div>

		<script src="js/cookiealert-standalone.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>
	<!-- Google Analytics -->
	<!-- End Google Analytics -->
   <script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<?php if (isset($_POST["search_word"])){ ?>
<script>get_ip_stack('<?php echo $_POST["search_word"];?>');</script>
<?php } ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116037384-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-116037384-1');
</script>
  </body>

</html>
