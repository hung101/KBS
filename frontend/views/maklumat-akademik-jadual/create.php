<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikJadual */

$this->title = 'Create Maklumat Akademik Jadual';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Jaduals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-jadual-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
		'readonly' => $readonly,
    ]) ?>

</div>
