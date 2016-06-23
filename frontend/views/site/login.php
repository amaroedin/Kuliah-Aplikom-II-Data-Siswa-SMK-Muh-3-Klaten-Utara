<?php
use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= Yii::$app->params['app_alias']; ?> Login</title>
	<?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>

	<div class="container-login">
		<div class="body-content">
			<div class="row">
				<?php $form = ActiveForm::begin(['action' => Url::base().'/site/login',]); ?>
				<div class="panel panel-primary">
					<div class="panel-heading"><strong>Administrator Login</strong></div>
					<div class="panel-body">
						<?= $form->field($model, 'username', ['template' => '<div class="input-bg"><i class="fa fa-user icon"></i>{input}{error}</div>'])->textInput(['class'=>'form-control', 'placeholder' => 'Username'])->label(false);?>
	                    <?= $form->field($model, 'password', ['template' => '<div class="input-bg"><i class="fa fa-lock icon"></i>{input}{error}</div>'])->passwordInput(['class'=>'form-control','placeholder'=>'Password'])->label(false);?>
	                    
	                    <div class="form-group text-center">
	                        <button type="submit" class="btn btn-danger btn-block">Sign In <i class="go go-arrow-forward"></i></button>
	                    </div>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>