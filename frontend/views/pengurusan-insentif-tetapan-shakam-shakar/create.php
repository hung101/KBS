<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapanShakamShakar */

$this->title = 'Create Pengurusan Insentif Tetapan Shakam Shakar';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insentif Tetapan Shakam Shakars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-tetapan-shakam-shakar-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
