<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunseling */

//$this->title = 'Update Permohonan Bimbingan Kaunseling: ' . ' ' . $model->permohonan_bimbingan_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_bimbingan_kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_bimbingan_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_bimbingan_kaunseling, 'url' => ['view', 'id' => $model->permohonan_bimbingan_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
