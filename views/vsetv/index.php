<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="<?php echo TEMPLATE; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo TEMPLATE; ?>css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?php echo TITLE; ?> - информационно-развлекательный медиапортал</title>
</head>
<body>
    <header>
      <div class="top-menu">
	         <nav class="navbar navbar-default">
                <div class="container">
                      <div class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" role="search" method="get">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Поиск...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                          </div>
                        </form>
                        <ul class="nav navbar-nav">
                          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Войти</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Регистрация</a></li>
                        </ul>
                      </div>
                </div><!-- /.container -->
            </nav>
      </div> <!-- /.top-menu -->
      <section class="menu-carousel">
    			<div id="carousel" class="carousel fade" data-ride="carousel">
              <div class="main-menu">
                  <nav class="navbar navbar-inverse" role="navigation">
                      <div class="container">
                        <div class="main-menu-bg">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                        <a class="navbar-brand" href="<?php echo PATH; ?>"><img src="<?php echo TEMPLATE; ?>images/logo-tv2.png"><span>VIPLIST</span></a>
                      </div>

                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">

                            <?php if (isset($_SESSION['admin'])):?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Мое<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?view=zagr">Загрузить</a></li>

                                <li><a href="?view=status">статус</a></li>


                                <li><a href="#">Другое действие</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo PATH;?>backup.php">backup</a></li>
                                <li class="divider"></li>
                                <li><a href="?view=xml">Xml</a></li>
                            </ul>
                        </li>
                            <?php endif;?>

                          <li class="active"><a href="#">Телепрограмма</a></li>
                          <li><a href="#">Мобильные приложения</a></li>
                          <li><a href="#">Радио онлайн</a></li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Развлечения<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="#">Действие</a></li>
                              <li><a href="#">Другое действие</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Отдельная ссылка</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Еще одна отдельная ссылка</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div><!-- /.navbar-collapse -->
                    </div> <!-- /.main-menu-bg -->
                    </div><!-- /.container-->
                </nav>
              </div> <!--  /.main-manu -->


    				<!-- Indicators -->

            <div class="carousel-indicators-wrap">
    					<ol class="carousel-indicators">
    						<li data-target="#carousel" data-slide-to="0" class="active"></li>
    						<li data-target="#carousel" data-slide-to="1"></li>
    					</ol>
    				</div> <!-- /.carousel-indicators-wrap -->
    				<!-- Wrapper for slides -->
    				<div class="carousel-inner">
    					<div class="item active">
    						<!-- <img src="img/slider.jpg" alt="slide"> -->
    						<div class="bg-carousel" style="background-image: url('<?php echo TEMPLATE; ?>images/slider1.jpg')"></div>
    						<div class="carousel-caption">
    							<h1>IPTV</h1>
    							<h3>Все телеканалы мира на одном портале</h3>
    							<a href="#" class="btn btn-f">Перейти к списку каналов</a>
    						</div>
    					</div>
    					<div class="item">
    						<div class="bg-carousel" style="background-image: url('<?php echo TEMPLATE; ?>images/slider2.jpg')"></div>
    						<div class="carousel-caption">
                  <h1>IPTV</h1>
    							<h3>Все телеканалы мира на одном портале</h3>
    							<a href="#" class="btn btn-f">Перейти к списку каналов</a>
    						</div>
    					</div>
    				</div> <!-- /.carousel fade -->

    				<!-- Controls -->
    				<a class="left carousel-control" href="#carousel" data-slide="prev">
    					<span class="glyphicon glyphicon-chevron-left"></span>
    				</a>
    				<a class="right carousel-control" href="#carousel" data-slide="next">
    					<span class="glyphicon glyphicon-chevron-right"></span>
    				</a>
    			</div>
		</section>
    </header>

    <section>
        <div class="container">
            <div class="row">
                
				 
				<div class="col-md-9">
						<?php /*if (isset($view))*/ include("content/".$view.".php"); ?>
				

					
					
                </div>
				
				
                <div class="col-md-3">
                    
					<?php include("content/right.php");?>
					
					
					
					
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2017 Все права защищены. </p>
                <span class="author"><span class="glyphicon glyphicon-edit"></span> Верстка сайта: <a href="https://vk.com/id18151433" target="_blank">Варавка Виталий</a></span>
            </div>
        </div>
    </footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo TEMPLATE; ?>js/bootstrap.min.js"></script>
</body>
</html>
