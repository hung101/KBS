<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanPendidikan */

//$this->title = $model->pengurusan_permohonan_pendidikan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_programkursusbengkel;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_programkursusbengkel, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-pendidikan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-pendidikan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_permohonan_pendidikan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-pendidikan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_permohonan_pendidikan_id], [
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
            'pengurusan_permohonan_pendidikan_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'jantina',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'emel',
            'facebook',
            'kelayakan_akademi',
            'perkerjaan',
            'nama_majikan',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
