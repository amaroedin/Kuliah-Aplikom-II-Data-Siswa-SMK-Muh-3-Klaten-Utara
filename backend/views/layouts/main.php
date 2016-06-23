<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\Session;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?= Yii::$app->params['app_name']; ?></title>

	<?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="sidebar-mini skin-red fixed">
	<?php $this->beginBody() ?>
	
	<div class="wrapper">
		<header class="main-header">
            <!-- Logo -->
            <a href="<?= Url::to(['home']); ?>" class="logo"><span class="logo-lg"><b><?= Yii::$app->params['app_alias']; ?></b></span></a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
            	<div class="navbar-custom-menu">
            		<a href="<?= Url::base(); ?>/site/logout" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
            	</div>
            </nav>
		</header>

		<!-- Begin-sidebar -->
		<div class="main-sidebar">
			<div class="slimScrollDiv">
				<div class="sidebar">
					<!-- Sidebar user -->
					<div class="user-panel">
						<div class="profile_pic">
							<?= Html::img('@web/static/images/default.jpg', ['class' => 'img-circle profile_img']);?>
						</div>
						<div class="profile_info">
							<span><?= Yii::$app->user->identity->nama;?></span>
							<h2><?= Yii::$app->user->identity->idGrup->nama;?></h2>
						</div>
					</div>

					<!-- Sidebar menu -->
					<?php if(Yii::$app->user->isAdmin()) { ?>
						<?= $this->render('/layouts/sidebar');?>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- / .End-sidebar -->

		<!-- Begin-content -->
		<div class="content-wrapper">
			<div class="slimScrollDiv">
				<div class="content-header">
					<div id="page-title">
						<h2><?= Yii::$app->params['current_menu'];?></h2>
					</div>

					<?php
		                Yii::$app->params['breadcrumbs'][(count(Yii::$app->params['breadcrumbs'])-1)]['template'] = "<li class='current'>{link}</li>";
		                
		                echo Breadcrumbs::widget([
		                    'links' =>Yii::$app->params['breadcrumbs'],
		                    'homeLink'=>false,
		                    'options'   =>['class'=>'breadcrumb'],
		                ]);
		            ?>
				</div>
				<div class="content">
					<div class="row">

					<?php $this->registerJs("
						$('.radio').addClass('radio-inline').removeClass('radio');
						", \yii\web\View::POS_END); ?>

						<?= $content; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- / .End-content -->

		<footer class="main-footer">
			<strong>Copyright &copy; 2016 || UMB Yogyakarta :: <a href="mailto:amarudhien@gmail.com">Amarudin M</a></strong>
		</footer>
	</div>
	<?php 
        if($pesan = Yii::$app->session->getAllFlashes()) {
            foreach($pesan as $key => $message) {
                echo "
                <script>
                $key(\"$message\");       
                </script>";
            }
        }
    ?>

	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>