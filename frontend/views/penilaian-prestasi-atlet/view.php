<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtlet */

//$this->title = $model->penilaian_prestasi_atlet_id;
$this->title = GeneralLabel::viewTitle . ' Penilaian Prestasi Atlet';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_prestasi_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-prestasi-atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penilaian_prestasi_atlet_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-prestasi-atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penilaian_prestasi_atlet_id], [
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
            'penilaian_prestasi_atlet_id',
            'atlet_id',
            'tahap_kesihatan',
            'tahap_kecederaan',
            'tahun_penilaian',
            'jadual_latihan',
            'nama_sukan',
            'nama_acara',
            'sasaran',
            'keputusan',
            'break_record',
            'maklumat_shakam_shakar',
        ],
    ]);*/ ?>

</div>
