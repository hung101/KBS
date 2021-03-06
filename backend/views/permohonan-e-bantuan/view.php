<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\RefStatusPermohonanEBantuan;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuan */

//$this->title = $model->permohonan_e_bantuan_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan e-Bantuan';
//$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Bantuan', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
        <?php if($model->hantar_flag == 0 || ($model->status_permohonan_id && $model->status_permohonan_id==RefStatusPermohonanEBantuan::STATUS_LULUS)): ?>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_e_bantuan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if($model->status_permohonan_id && $model->status_permohonan_id==RefStatusPermohonanEBantuan::STATUS_TOLAK): ?>
        <?=Html::a('Surat', ['surat', 'id' => $model->permohonan_e_bantuan_id], ['class' => 'btn btn-info', 'target' => '_blank'])?>
        <?php endif; ?>
        <?php if($model->hantar_flag == 0): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->permohonan_e_bantuan_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a('Kembali', ['site/e-bantuan-home'], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonan' => $searchModelPermohonan,
        'dataProviderPermohonan' => $dataProviderPermohonan,
        'searchModelOP' => $searchModelOP,
        'dataProviderOP' => $dataProviderOP,
        'searchModelJawatankuasa' => $searchModelJawatankuasa,
        'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
        'searchModelSAP' => $searchModelSAP,
        'dataProviderSAP' => $dataProviderSAP,
        'searchModelPTL' => $searchModelPTL,
        'dataProviderPTL' => $dataProviderPTL,
        'searchModelAP' => $searchModelAP,
        'dataProviderAP' => $dataProviderAP,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_e_bantuan_id',
            'nama_pertubuhan_persatuan',
            'no_pendaftaran',
            'tarikh_didaftarkan',
            'pejabat_yang_mendaftarkan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'alamat_surat_menyurat_1',
            'alamat_surat_menyurat_2',
            'alamat_surat_menyurat_3',
            'alamat_surat_menyurat_negeri',
            'alamat_surat_menyurat_bandar',
            'alamat_surat_menyurat_poskod',
            'no_telefon_pejabat',
            'no_telefon_bimbit',
            'no_fax',
            'email:email',
            'bilangan_keahlian',
            'bilangan_cawangan_badan_gabungan',
            'objektif_pertubuhan',
            'aktiviti_dan_kejayaan_yang_dicapai',
        ],
    ])*/ ?>

</div>
