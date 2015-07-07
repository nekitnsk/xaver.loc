<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Форма добавления дома в каталог</title>

		<!-- Google web fonts -->
		<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/jumbotron.css" rel="stylesheet" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

	</head>

	
<body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Каталог домов. Административная панель</h3>
      </div>

      <div class="jumbotron">
        <h2>Форма добавления домов в каталог</h2>
        <p class="lead">Пожалуйста, следуйте рекомендациями в описании блоков</p>

      </div>

      <div class="row marketing">

      	<!--рыба -->
      	<div class="form-group">
				<label for="" class="col-sm-4 control-label">
				<p><span class="comment"></span></p></label>
				<div class="col-sm-8">
					<input type="" class="form-control" id="" placeholder="Например, ">
				</div>
			</div>

		<form class="form-horizontal">
			<h4>Наименование дома</h4>
			<hr>
			<div class="form-group">
				<label for="name" class="col-sm-4 control-label">Название дома
				<p><span class="comment">Это название будет использовано в названии файлов и картинок. А также отображаться над главной странице каталога в качестве названия дома.</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="name" placeholder="Например, Aero Polar 42">
				</div>
			</div>

			<div class="form-group">
				<label for="head1" class="col-sm-4 control-label">Заголовок описания
				<p><span class="comment">Это большой заголовок в подробном описании дома</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="head1" placeholder="Например, ДОМ AERO POLAR 42 ИЗ ДВОЙНОГО БРУСА">
				</div>
			</div>

			<div class="form-group">
				<label for="head2" class="col-sm-4 control-label">Заголовок №2 
				<p><span class="comment">Это подзаголовок в разделе описания дома</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="head2" placeholder="Например, Дом из двойного бруса">
				</div>
			</div>

			
			<h4>Используемые материалы</h4>
			<hr>

			<div class="form-group">
				<label for="roof" class="col-sm-4 control-label">Материал крыши
				<p><span class="comment">Введите материал крыши</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="roof" placeholder="Например, Металлочерепица">
				</div>
			</div>
			<div class="form-group">
				<label for="wall" class="col-sm-4 control-label">Материал стен
				<p><span class="comment">Введите материал стен</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="wall" placeholder="Например, Двойной брус 150х150">
				</div>
			</div>
			<div class="form-group">
				<label for="fundament" class="col-sm-4 control-label">Тип фундамента
				<p><span class="comment">Введите тип фундамента</span></p></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="fundament" placeholder="Например, Винтовые сваи">
				</div>
			</div>
			<h4>Конструктивные особенности дома</h4>
			<h6>В каждом пункте два поля,в первое поле следует ввести название, например, Лестница.<br>
				во втором поле следует ввести описание данной характеристики</h6>
			<hr>
			
			
			<?php 
				for ($i=0; $i < 10; $i++) { 
					?>
					<div class="form-group">
						<label for="feature<?php echo $i+1 ?>" class="col-sm-2 control-label"><?php echo $i+1 ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="feature<?php echo $i+1 ?>" placeholder="Например, Утепление">
							<input type="text" class="form-control" id="feature<?php echo $i+1 ?>_desc" placeholder="Например, Экстра вата,толщиной 100мм.">
						</div>
					</div>
					<?php

				}

			?>

			<h4>Описание дома</h4>
			<hr>
			<div class="form-group">
				<label for="description1" class="col-sm-4 control-label">Описание дома
					<p><span class="comment">Здесь можете написать описание дома, кому здесь хорошо жить, чем он интересен, чем уникален, для кого подходит и т.п.</span></p></label>
					<div class="col-sm-8">
						<textarea rows = 15 class="form-control" id="description1" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
				<label for="description2" class="col-sm-4 control-label">Дополнительно
					<p><span class="comment">Дополнительный блок. Будет показан отдельным разделом, как описание дома, например. Введите название блока и описание.</span></p></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="title_description2" placeholder="Например, Стоимость дома с участком">
						<textarea rows = 10 class="form-control" id="description2" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
				<label for="description3" class="col-sm-4 control-label">Дополнительно 2
					<p><span class="comment">Дополнительный блок. Будет показан отдельным разделом, как описание дома, например. Введите название блока и описание.</span></p></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="title_description3" placeholder="Например, В стоимость дома входит">
						<textarea rows = 10 class="form-control" id="description3" placeholder=""></textarea>
					</div>
				</div>

				<h4>Стоимость дома</h4>
				<hr>
				<div class="form-group">
					<label for="price" class="col-sm-4 control-label">Стоимость дома
						<p><span class="comment">Можете ввести стоимость дома в произвольной форме, не только цифры, а какую либо добавочную информацию</span></p></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="price" placeholder="Например, 790 000 рублей до конца лета ">
						</div>
					</div>






			<hr>
			
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<label for = "upl" class="col-sm-2 control-label">Выберите файлы для загрузки</label>


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember me
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
			</div>
		</form>

		<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
					<div >
						
						<input type="file" name="upl" multiple />
					</div>

					<ul>
						<!-- The file uploads will be shown here -->
					</ul>

				</form>

      <footer class="footer">
        <p>&copy; Company 2014</p>
      </footer>

    </div> <!-- /container -->


    <!-- JavaScript Includes -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>;
		<script src="assets/js/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="assets/js/jquery.ui.widget.js"></script>
		<script src="assets/js/jquery.iframe-transport.js"></script>
		<script src="assets/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
		<script src="assets/js/script.js"></script>
  </body>

</html>