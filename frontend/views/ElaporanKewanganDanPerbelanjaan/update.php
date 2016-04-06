<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_kewangan_dan_perbelanjaan.': ' . ' ' . $model->elaporan_kewangan_dan_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_kewangan_dan_perbelanjaans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_kewangan_dan_perbelanjaan_id, 'url' => ['view', 'id' => $model->elaporan_kewangan_dan_perbelanjaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-kewangan-dan-perbelanjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
