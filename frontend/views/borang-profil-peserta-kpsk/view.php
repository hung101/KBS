<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpsk */

//$this->title = $model->borang_profil_peserta_kpsk_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_profil_peserta_kpsk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_profil_peserta_kpsk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(($model->hantar_flag == 0 && isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['update'])) || 
                !Yii::$app->user->identity->profil_badan_sukan): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->borang_profil_peserta_kpsk_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->borang_profil_peserta_kpsk_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if($model->hantar_flag == 0 && isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['update'])): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->borang_profil_peserta_kpsk_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a('Hantar Keputusan Melalui Emel', ['hantar-keputusan-emel', 'borang_profil_peserta_kpsk_id' => $model->borang_profil_peserta_kpsk_id], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
        'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
        'readonly' => $readonly,
		'disabled' => false,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'borang_profil_peserta_kpsk_id',
            'penganjur_kursus',
            'kod_kursus',
            'tarikh_kursus',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
