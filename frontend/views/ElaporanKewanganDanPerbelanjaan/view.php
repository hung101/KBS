<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */

$this->title = $model->elaporan_kewangan_dan_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Kewangan Dan Perbelanjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-kewangan-dan-perbelanjaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->elaporan_kewangan_dan_perbelanjaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->elaporan_kewangan_dan_perbelanjaan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'elaporan_kewangan_dan_perbelanjaan_id',
            'elaporan_pelaksaan_id',
            'program_aktiviti_butir',
            'jenis_kewangan',
            'jumlah',
        ],
    ]) ?>

</div>
