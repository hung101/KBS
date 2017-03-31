<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpsk */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::borang_profil_peserta_kpsk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_profil_peserta_kpsk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
        'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
        'disabled' => $disabled,
		'readonly' => $readonly,
    ]) ?>

</div>
