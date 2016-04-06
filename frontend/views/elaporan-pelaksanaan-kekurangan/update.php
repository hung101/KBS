<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKekurangan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_pelaksanaan_kekurangan.': ' . ' ' . $model->elaporan_pelaksanaan_kekurangan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_kekurangan, 'url' => ['index']];
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
