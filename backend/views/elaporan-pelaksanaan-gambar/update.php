<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanGambar */

$this->title = 'Update Elaporan Pelaksanaan Gambar: ' . ' ' . $model->elaporan_pelaksanaan_gambar_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Gambars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_pelaksanaan_gambar_id, 'url' => ['view', 'id' => $model->elaporan_pelaksanaan_gambar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-pelaksanaan-gambar-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
