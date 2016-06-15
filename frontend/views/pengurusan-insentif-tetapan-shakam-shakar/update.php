<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapanShakamShakar */

$this->title = 'Update Pengurusan Insentif Tetapan Shakam Shakar: ' . $model->pengurusan_insentif_tetapan_shakam_shakar_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insentif Tetapan Shakam Shakars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_insentif_tetapan_shakam_shakar_id, 'url' => ['view', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-insentif-tetapan-shakam-shakar-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
