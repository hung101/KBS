<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanAtlet */

//$this->title = $model->anugerah_pencalonan_atlet;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-atlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->anugerah_pencalonan_atlet], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->anugerah_pencalonan_atlet], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anugerah_pencalonan_atlet',
            'nama_atlet',
            'tahun_pencalonan',
            'nama_sukan',
            'nama_acara',
            'status_pencalonan',
            'kejayaan',
            'ulasan_kejayaan',
            'susan_ranking_kebangsaan',
            'susan_ranking_asia',
            'susan_ranking_asia_tenggara',
            'susan_ranking_dunia',
            'sifat_kepimpinan_ketua_pasukan',
            'sifat_kepimpinan_jurulatih',
            'sifat_kepimpinan_asia_tenggara',
            'sifat_kepimpinan_penolong_jurulatih',
            'sifat_kepimpinan_pegawai_teknikal',
            'nama_sukan_sebelum_dicalon',
            'mewakili',
            'pencalonan_olahragawan_tahun',
            'pencalonan_olahragawati_tahun',
            'pencalonan_pasukan_lelaki_kebangsaan_tahun',
            'pencalonan_pasukan_wanita_kebangsaan_tahun',
            'pencalonan_olahragawan_harapan_tahun',
            'pencalonan_olahragawati_harapan_tahun',
            'memenangi_kategori_dalam_anugerah_sukan',
            'nama_kategori',
            'tahun',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
