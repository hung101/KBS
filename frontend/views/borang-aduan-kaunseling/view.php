<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKaunseling */

//$this->title = $model->borang_aduan_kaunseling_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_aduan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kaunseling-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->borang_aduan_kaunseling_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->borang_aduan_kaunseling_id], [
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
            'borang_aduan_kaunseling_id',
            'nama_pengadu',
            'tarikh_aduan',
            'no_aduan',
            'status_aduan',
            'aduan_kategori',
            'penyataan_aduan',
            'tindakan_yang_telah_diambil',
            'dokumen_berkaitan_yang_dilampirkan',
            'bantuan_yang_anda_perlukan',
            'rujukan_aduan_kepada_cawangan_yang_berkaitan',
            'rujuk_aduan_kepada_atlet',
            'tiada_sebarang_tindakan',
            'maklumbalas_kepada_pengadu',
            'tindakan_susulan',
            'aduan_dimajukan_kepada_agensi_lain',
            'catatan',
        ],
    ]);*/ ?>

</div>
