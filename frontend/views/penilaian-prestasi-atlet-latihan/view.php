<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletLatihan */

//$this->title = $model->tbl_penilaian_prestasi_atlet_latihan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::jadual_latihan_periodisasi_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jadual_latihan_periodisasi_jurulatih, 'url' => ['index', 'penilaian_prestasi_atlet_sasaran_id' =>$model->penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$model->atlet_id, 'penilaian_pestasi_id' =>$model->penilaian_pestasi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-latihan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->tbl_penilaian_prestasi_atlet_latihan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->tbl_penilaian_prestasi_atlet_latihan_id, 'penilaian_prestasi_atlet_sasaran_id' =>$model->penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$model->atlet_id, 'penilaian_pestasi_id' =>$model->penilaian_pestasi_id], [
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
            'tbl_penilaian_prestasi_atlet_latihan_id',
            'jadual_latihan_periodisasi_jurulatih_id',
            'tarikh_mula',
            'tarikh_tamat',
            'tempoh',
            'tempat',
            'keterangan:ntext',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
