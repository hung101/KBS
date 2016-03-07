<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatKongresDiLuarNegara */

$this->title = $model->maklumat_kongres_di_luar_negara_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Kongres Di Luar Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-kongres-di-luar-negara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->maklumat_kongres_di_luar_negara_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->maklumat_kongres_di_luar_negara_id], [
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
            'maklumat_kongres_di_luar_negara_id',
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id',
            'tajuk',
            'tempat',
            'masa',
            'tarikh_penerbangan',
            'tiket_penerbangan',
            'jumlah_penerbangan',
            'lain_lain',
            'jumlah_kos_lain_lain',
            'nama_pegawai_terlibat',
        ],
    ]) ?>

</div>
