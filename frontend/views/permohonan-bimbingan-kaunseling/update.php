<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunseling */

//$this->title = 'Update Permohonan Bimbingan Kaunseling: ' . ' ' . $model->permohonan_bimbingan_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Bimbingan Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Bimbingan Kaunseling', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Bimbingan Kaunseling', 'url' => ['view', 'id' => $model->permohonan_bimbingan_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
