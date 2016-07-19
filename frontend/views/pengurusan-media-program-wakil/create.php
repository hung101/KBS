<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgramWakil */

$this->title = 'Create Pengurusan Media Program Wakil';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Media Program Wakils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-media-program-wakil-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
