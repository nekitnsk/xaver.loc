<?php 

//подключение DBSimple
require_once "../../lib/dbsimple/config.php";
require_once "../../lib/dbsimple/DbSimple/Generic.php";

$config = parse_ini_file('../../config.ini', true);

$db = DbSimple_Generic::connect('mysqli://' . $config['Database1']['user'] . ':' . $config['Database1']['password'] . '@' . $config['Database1']['host'] . '/' . $config['Database1']['database'] . '');

// $db = DbSimple_Generic::connect('mysqli://root:123@localhost/house');

// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');

// $db->setLogger('MyLogger'); 
// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if (!error_reporting())
        return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();


}
$id =$_GET['id'];
$directory= '../images/house/'.$id;
$image_list = array_diff(scandir($directory), array('..', '.'));

$h = $db->selectRow('SELECT seo_name, space, head1, head2, roof, wall, fundament, feature1, feature2, feature3, feature4, feature5, feature6, feature7, feature8, feature9, feature10, feature2_desc, feature1_desc, feature4_desc, feature6_desc, feature5_desc, feature3_desc, feature7_desc, feature9_desc, feature8_desc, feature10_desc, description1, title_description2, description2, title_description3, description3, cost, price FROM dom WHERE seo_name = ? ', $id);
// print_r($house_one);
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
</head>
<body> 



<!-- PAGE CONTENT -->
<div id="page-content" class="fixed-header">

	
    
	<!-- PAGEBODY -->
	<div class="page-body">
    
		<!-- PORTFOLIO SECTION -->
		<section id="portfolio">
			<div id="portfolio-single" class="section-inner">
				<div class="wrapper clearfix">
				
				<div class="section-title project-title">
					<h2 class="project-name"><?php echo($h["head1"]);?></h2>
										
				</div>
					 
				<ul class="socialmedia-widget social-share">
					<li class="facebook"><a href="">Facebook</a></li>
					<li class="twitter"><a href="">Tweet</a></li>
					<li class="googleplus"><a href="">Google Plus</a></li>
					<li class="pinterest"><a href="">Pinterest</a></li>
				</ul>
				
				<div class="main-content left-float">
					<!-- GALLERY -->	
					<div class="entry-media portfolio-media">
					<div class="flexslider portfolio-slider">
						<ul class="img_item">
							
							<?php
							foreach ($image_list as $key => $value) {
								?>
									<li><img src="files/images/house/<?php echo($id); ?>/<?php echo($value);?>" alt="<?php echo($id); ?>"/></li>

								<?php
							}
							?>
							
						</ul>
					</div>  
					</div>
					<!-- GALLERY -->
				</div> <!-- END .main-content -->
				
				<!-- SIDEBAR -->  
              	<aside class="right-float">
					<div class="entry-content portfolio-content">
						<h4 class="head_center"><strong><?php echo($h['head2']); ?></strong></h4>
						<h5><strong>Используемые материалы:</strong></h5>
						<h5><strong>Конструктивные особенности дома:</strong></h5>
						<p>

							<?php 
							for ($i=1; $i < 11; $i++) { 
								if (!$h['feature'.$i]=='' && !$h['feature'.$i.'_desc']==''){
								?>

									<span><i class="fa fa-check-square-o fa-fw"></i><strong><?php echo($h['feature'.$i]); ?> </strong><?php echo($h['feature'.$i.'_desc']);?></span>		
							
								<?php
							}
							}

							?>
					</p>

						<h5><strong>Описание дома:</strong></h5>
						<?php echo($h['description1']);?>

						<?php 
						if (!$h['title_description2']==''){
							?>
						<h5><strong><?php echo($h['title_description2'])?></strong></h5>
						<?php echo($h['description2']);?>

						<?php
					}
					?>

						<?php 
						if (!$h['title_description3']==''){
							?>
						<h5><strong><?php echo($h['title_description2'])?></strong></h5>
						<?php echo($h['description3']);?>


							<?php


						}


						?>

						<h5><strong>Стоимость дома: <?php echo($h['price']);?></strong></h5>




					</div>
				</aside>
				<!-- SIDEBAR -->
					
				</div> <!-- END .wrapper --> 
				
				<div class="spacer spacer-big"></div>
				
			</div> <!-- END #portfolio-single .section-inner -->
    	</section> <!-- END SECTION #portfolio-->
		<!-- PORTFOLIO SECTION -->
        
      	
        
 	</div> <!-- END .page-body -->
	<!-- PAGEBODY -->
    
</div> <!-- END #page-content -->
<!-- PAGE CONTENT -->



</body>
</html>