<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanUbatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::farmasi_permohonan_ubatan.': ' . ' ' . $model->farmasi_permohonan_ubatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_ubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_ubatan, 'url' => ['view', 'id' => $model->farmasi_permohonan_ubatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-ubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
        'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
        'readonly' => $readonly,
    ]) ?>

</div>
