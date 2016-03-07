<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */

$this->title = 'Update Permohonan Ebantuan Anggaran Perbelanjaan: ' . ' ' . $model->anggaran_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Anggaran Perbelanjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anggaran_perbelanjaan_id, 'url' => ['view', 'id' => $model->anggaran_perbelanjaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-anggaran-perbelanjaan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
