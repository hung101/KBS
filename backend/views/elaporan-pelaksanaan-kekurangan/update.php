<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKekurangan */

$this->title = 'Update Elaporan Pelaksanaan Kekurangan: ' . ' ' . $model->elaporan_pelaksanaan_kekurangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Kekurangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_pelaksanaan_kekurangan_id, 'url' => ['view', 'id' => $model->elaporan_pelaksanaan_kekurangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-pelaksanaan-kekurangan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
