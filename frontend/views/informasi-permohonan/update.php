<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPermohonan */

//$this->title = 'Update Informasi Permohonan: ' . ' ' . $model->informasi_permohonan_id;
$this->title = GeneralLabel::updateTitle . ' Lampiran Perbelanjaan/Resit';
$this->params['breadcrumbs'][] = ['label' => 'Lampiran Perbelanjaan/Resit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Lampiran Perbelanjaan/Resit', 'url' => ['view', 'id' => $model->informasi_permohonan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-permohonan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
