<?php

//подключение DBSimple
require_once "lib/dbsimple/config.php";
require_once "lib/dbsimple/DbSimple/Generic.php";

$config = parse_ini_file('./config.ini', true);

$db = DbSimple_Generic::connect('mysqli://' . $config['Database1']['user'] . ':' . $config['Database1']['password'] . '@' . $config['Database1']['host'] . '/' . $config['Database1']['database'] . '');



$house = $db->select('SELECT seo_name AS ARRAY_KEY, id, name, seo_name, space, cost, category, default_house, main_photo FROM dom ');


?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en-US"> <!--<![endif]-->
<head>

<!-- DEFAULT META TAGS -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Каталог домов</title>
<!-- DEFAULT META TAGS -->

<!-- FONTS -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,800,600|Raleway:300,600,900' rel='stylesheet' type='text/css'>
<!-- FONTS -->

<!-- CSS -->
<link rel='stylesheet' id='default-style-css'  href='files/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='isotope-style-css'  href='files/css/isotope.css' type='text/css' media='all' />
<link rel="stylesheet" id='rsplugin-style-css' href="files/rs-plugin/css/settings.css" type="text/css" media="all" />
<link rel="stylesheet" id='fontawesome-style-css' href="files/css/font-awesome.min.css" type="text/css" media="all" />
<link rel='stylesheet' id='retina-style-css'  href='files/css/retina.css' type='text/css' media='all' />
<link rel='stylesheet' id='mqueries-style-css'  href='files/css/mqueries.css' type='text/css' media='all' />
<!-- CSS -->

<!-- FAVICON -->
<link rel="shortcut icon" href="files/images/icon/favicon.ico"/>
<!-- FAVICON -->

<!-- JQUERY LIBRARY & MODERNIZR -->
<script src="files/js/jquery-1.9.1.min.js"></script>
<script src='files/js/jquery.modernizr.min.js'></script>
<!-- JQUERY LIBRARY & MODERNIZR -->

</head>

<body> 

<!-- PAGELOADER -->
<div id="page-loader">
	<div class="page-loader-inner">
    	<div class="loader-logo"><i class="fa fa-home fa-5x fa-fw"></i></div>
		<div class="loader-icon"><span class="spinner"></span><span></span></div>
	</div>
</div>
<!-- PAGELOADER -->

<!-- PAGE CONTENT -->
<div id="page-content" class="fixed-header">

	
    
	<!-- PAGEBODY -->
	<div class="page-body">
    
		

		
		<!-- Boxed Layout -->   
        <div class="wrapper">

          <div class="section-title">
                    <h2>Каталог домов</h2>
                    <div class="seperator size-small"><span></span></div>
                    <h4 class="subtitle">Воспользуйтесь фильтром по категориям</h4>
                </div>
          
          <div class="seperator size-mini height-small"><span></span></div>




          
          <div class="spacer spacer-small"></div>
          
          <ul id="portfolio-filter5" class="filter clearfix" data-related-grid="portfolio-grid5">


            <li class = "li_hidden"><a data-option-value=".default" href="#" title="Default">Default</a></li>
            <!--<li><a data-option-value=".brick" href="#" title="Кирпич">Кирпич</a></li>-->
            <!--<li><a data-option-value=".log" href="#" title="Оцилиндрованное бревно">Оцилиндрованное бревно</a></li>-->
            <li><a data-option-value=".sandwich" href="#" title="Сэндвич панели">Сэндвич панели</a></li>
            <li><a data-option-value=".rod" href="#" title="Двойной брус">Двойной брус</a></li>
            <!--<li><a data-option-value=".sibit" href="#" title="Motion">Сибит</a></li>-->
            
          </ul>
        
        <div id="portfolio-grid5" class="masonry portfolio-entries portfolio-spaced clearfix" data-maxitemwidth="370">
        
        <?php
          foreach ($house as $key => $value) {
                      
            ?>
                  <div class="portfolio-masonry-entry masonry-item <?php echo ($value["category"]); if ($value["default_house"]=='true'){echo (" default");}?> ">
                    <div class="entry-intro portfolio-intro">
                      <div class="intro-headline portfolio-intro-headline">
                        <h5 class="portfolio-name"><a href="files/page/house.php?id=<?php echo($key);?>" class="load-content"><strong><?php echo ($value["name"]);?></strong></a></h5>
                      </div>
                    </div>
                    <div class="entry-thumb portfolio-thumb"> 
                      <div class="imgoverlay text-light">
                        <a href="files/page/house.php?id=<?php echo($key); ?>" class="load-content">
                          <img src="files/images/house/<?php echo ($value["seo_name"]);?>/<?php echo ($value["main_photo"]);?>" alt="<?php echo ($value["seo_name"]);?>" />
                          <div class="overlay"><span class="overlaycolor"></span><div class="overlayinfo"><h6>Площадь <?php echo ($value["space"]);?> м<sup>2</sup><br>Стоимость от <?php echo ($value['cost']);?> руб.<br><ins>подробнее</ins></h6></div></div>
                        </a>
                        </div>
                    </div>
          </div>  

            <?php
          }
        ?>
          
        
        </div> <!-- END #portfolio-grid1 -->
        </div> <!-- END .wrapper --> 
        <!-- Boxed Layout -->

           <!-- AJAX AREA -->    
           <div id="ajax-portfolio" class="ajax-section">
            <div id="ajax-loader"><div class="loader-icon"><span class="spinner"></span><span></span></div></div>
            <div class="ajax-content clearfix"> 
              <!-- THE LOADED CONTENT WILL BE ADDED HERE -->
            </div>
            <div class="close-project"><a href="index.php">Закрыть</a></div>
          </div>    
          <!-- AJAX AREA -->   



         	<div class="spacer spacer-big"></div>   
           
		   	
        
      	<!-- FOOTER -->  
		<footer>
			<div class="footerinner wrapper align-center text-light">
				<a id="backtotop" href="#" class="sr-button sr-buttonicon small-iconbutton"><i class="fa fa-angle-up"></i></a>
				<p class="footer-logo"><i class="fa fa-home fa-5x fa-fw"></i></p>
             	<ul class="socialmedia-widget social-share">
 					<li class="facebook"><a href="#">Facebook</a></li>
  					<li class="twitter"><a href="#">Tweet</a></li>
 					<li class="linkedin"><a href="#">Google Plus</a></li>
 					<li class="dribbble"><a href="#">Dribble</a></li>
 					<li class="behance"><a href="#">Behance</a></li>
 					<li class="instagram"><a href="#">Instagram</a></li>
            	</ul>
            	<p class="copyright">Copyright &copy; 2015 Каталог домов</p>
         	</div>
    	</footer>
      	<!-- FOOTER -->         
        
 	</div> <!-- END .page-body -->
	<!-- PAGEBODY -->
    
</div> <!-- END #page-content -->
<!-- PAGE CONTENT -->


<!-- SCRIPTS -->
<script type='text/javascript' src='files/js/retina.js'></script>
<script type='text/javascript' src='files/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='files/js/jquery.easing.compatibility.js'></script>
<script type='text/javascript' src='files/js/jquery.visible.min.js'></script>
<script type='text/javascript' src='files/js/jquery.easy-opener.min.js'></script>
<!--<script type='text/javascript' src='files/js/jquery.flexslider.min.js'></script>-->
<script type='text/javascript' src='files/js/jquery.isotope.min.js'></script>
<!--<script type='text/javascript' src='files/js/jquery.fitvids.min.js'></script>-->
<!--<script type='text/javascript' src='files/jplayer/jquery.jplayer.min.js'></script>-->
<!--<script type="text/javascript" src="files/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>-->
<!--<script type="text/javascript" src="files/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>-->
<!--<script type='text/javascript' src='files/js/jquery.parallax.min.js'></script>-->
<!--<script type='text/javascript' src='files/js/jquery.counter.min.js'></script>-->
<script type='text/javascript' src='files/js/jquery.scroll.min.js'></script>
<script type='text/javascript' src='files/js/xone-header.js'></script>
<script type='text/javascript' src='files/js/xone-loader.js'></script>
<script type='text/javascript' src='files/js/xone-form.js'></script>
<script type='text/javascript' src='files/js/script.js'></script>
<!-- SCRIPTS -->

</body>
</html>