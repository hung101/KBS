<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKelebihan */

$this->title = 'Update Elaporan Pelaksanaan Kelebihan: ' . ' ' . $model->elaporan_pelaksanaan_kelebihan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Kelebihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_pelaksanaan_kelebihan_id, 'url' => ['view', 'id' => $model->elaporan_pelaksanaan_kelebihan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-pelaksanaan-kelebihan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
