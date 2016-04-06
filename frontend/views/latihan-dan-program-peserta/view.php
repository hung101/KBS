<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramPeserta */

$this->title = $model->latihan_dan_program_peserta_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::latihan_dan_program_pesertas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-dan-program-peserta-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->latihan_dan_program_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->latihan_dan_program_peserta_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'latihan_dan_program_peserta_id',
            'latihan_dan_program_id',
            'nama',
            'no_kad_pengenalan',
            'nama_badan_sukan',
            'no_pendaftaran_sukan',
            'jawatan',
            'tempoh_memegang_jawatan',
            'no_tel_bimbit',
            'emel',
        ],
    ]);*/ ?>

</div>
