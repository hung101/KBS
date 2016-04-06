<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjur */

//$this->title = $model->penganjur_id;
$this->title =  'Penganjuran Acara Sukan Yang Disanksi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_acara_sukan_yang_disanksi, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="paobs-penganjur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penganjur_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penganjur_id], [
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
            'penganjur_id',
            'penganjuran_id',
            'profil_syarikat',
            'nama_penganjur',
            'no_pendaftaran_syarikat',
            'tarikh_penubuhan_syarikat',
            'sijil_pendaftaran',
            'alamat_penganjur',
            'no_telefon_penganjur',
            'no_faks_penganjur',
            'emel_penganjur',
            'kertas_cadangan_pelaksanaan',
            'nama_aktiviti',
            'jenis_sukan',
            'tarikh_aktiviti',
            'alamat_lokasi',
            'pemilik_lokasi',
            'bilangan_peserta',
            'negara_peserta',
            'kos_aktiviti',
            'sumber_kewangan',
            'surat_sokongan',
            'laporan_penganjuran',
        ],
    ]);*/ ?>

</div>
