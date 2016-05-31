<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpskPeserta */

$this->title = 'Update Borang Profil Peserta Kpsk Peserta: ' . $model->borang_profil_peserta_kpsk_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Profil Peserta Kpsk Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_profil_peserta_kpsk_peserta_id, 'url' => ['view', 'id' => $model->borang_profil_peserta_kpsk_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-profil-peserta-kpsk-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
