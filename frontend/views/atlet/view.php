<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$this->title = $model->atlet_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->atlet_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->atlet_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => true,
    ]) ?>

    <?php
    /* echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'atlet_id',
            'tahap',
            'name_penuh',
            'tarikh_lahir',
            'umur',
            'tempat_lahir_bandar',
            'tempat_lahir_negeri',
            'bangsa',
            'agama',
            'jantina',
            'taraf_perkahwinan',
            'tinggi',
            'berat',
            'bahasa_ibu',
            'no_sijil_lahir',
            'ic_no',
            'ic_no_lama',
            'passport_no',
            'passport_tempat_dikeluarkan',
            'lesen_memandu_no',
            'lesen_tamat_tempoh',
            'jenis_lesen',
            'tel_bimbit_no_1',
            'tel_bimbit_no_2',
            'tel_no',
            'emel',
            'facebook',
            'twitter',
            'alamat_rumah_1',
            'alamat_surat_menyurat_1',
            'dari_bahagian',
            'sumber',
            'negeri_diwakili',
            'nama_kecemasan',
            'pertalian_kecemasan',
            'tel_no_kecemasan',
            'tel_bimbit_no_kecemasan',
        ],
    ])*/ ?>

</div>
