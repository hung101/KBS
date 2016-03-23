<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbang */

//$this->title = $model->permohonan_kemudahan_ticket_kapal_terbang_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], [
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
            'permohonan_kemudahan_ticket_kapal_terbang_id',
            'nama_pemohon',
            'bahagian',
            'jawatan',
            'destinasi',
            'tarikh',
            'nama_program',
            'no_fail_kelulusan',
            'bil_penumpang',
            'aktiviti',
            'kod_perbelanjaan',
            'sukan',
            'atlet',
            'jurulatih',
            'pegawai_teknikal',
            'kelulusan',
        ],
    ])*/ ?>

</div>
