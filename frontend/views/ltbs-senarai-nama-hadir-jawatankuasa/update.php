<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirJawatankuasa */

$this->title = 'Update Ltbs Senarai Nama Hadir Jawatankuasa: ' . ' ' . $model->senarai_nama_hadi_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltbs Senarai Nama Hadir Jawatankuasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_nama_hadi_id, 'url' => ['view', 'id' => $model->senarai_nama_hadi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltbs-senarai-nama-hadir-jawatankuasa-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
