<?php 
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="contentpane" style="background:#eee;padding:15px;">
	<div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>
<script type="text/javascript">
	$(function(){
		equalHeight($('#contentpane .box'));
	});
</script>
