<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpsk */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::borang_profil_peserta_kpsk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_profil_peserta_kpsk, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_profil_peserta_kpsk, 'url' => ['view', 'id' => $model->borang_profil_peserta_kpsk_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
        'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
