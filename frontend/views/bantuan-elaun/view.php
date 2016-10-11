<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanElaun */

//$this->title = $model->bantuan_elaun_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_elaun_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_elaun_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if($model->jenis_bantuan_id == app\models\RefJenisBantuanSue::ELAUN_SUE && $model->status_permohonan_id == app\models\RefStatusPermohonanSue::LULUS): ?>
            <?= Html::a('Muat Turun Job Skop Lampiran', \Yii::$app->request->BaseUrl.'/downloads/pelantikan-sue/jobskop_lampiran.pdf' , ['class'=>'btn btn-warning', 'target'=>'_blank'])?>
            <?= Html::a(GeneralLabel::generate . ' ' . GeneralLabel::surat_lantikan_sue, ['surat-lantikan-sue', 'sue_id' => $model->bantuan_elaun_id], ['class' => 'btn btn-warning', 'target' => '_blank']); ?>
        <?= Html::a(GeneralLabel::generate . ' ' . GeneralLabel::surat_persetujuan_sue, ['surat-persetujuan-sue', 'sue_id' => $model->bantuan_elaun_id], ['class' => 'btn btn-warning', 'target' => '_blank']); ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_elaun_id',
            'nama',
            'muatnaik_gambar',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'umur',
            'jantina',
            'kewarganegara',
            'bangsa',
            'agama',
            'kelayakan_akademi',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'emel',
            'kontrak',
            'jumlah_elaun',
            'muatnaik_dokumen',
            'status_permohonan',
            'catatan',
        ],
    ]);*/ ?>

</div>
