<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMaklumBalasPeserta */

//$this->title = $model->pengurusan_maklum_balas_peserta_id;
$this->title = GeneralLabel::viewTitle . ' Kehadiran Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklum-balas-peserta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_maklum_balas_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_maklum_balas_peserta_id], [
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
        'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
        'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_maklum_balas_peserta_id',
            'nama_penganjuran_kursus',
            'kod_kursus',
            'tarikh_kursus',
            'catatan',
        ],
    ]);*/ ?>

</div>
