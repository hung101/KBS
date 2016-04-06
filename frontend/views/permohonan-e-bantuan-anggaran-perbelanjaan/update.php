<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_anggaran_perbelanjaan.': ' . ' ' . $model->anggaran_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_anggaran_perbelanjaans, 'url' => ['index']];
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
