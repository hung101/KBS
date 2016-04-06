<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat */

$this->title = $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id], [
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
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id',
            'nama',
            'no_kad_pengenalan',
            'jawatan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'emel',
            'muatnaik_dokumen',
            'nama_kejohonan',
            'muatnaik_dokumen_kejohanan',
            'status_permohonan',
        ],
    ]) ?>

</div>
