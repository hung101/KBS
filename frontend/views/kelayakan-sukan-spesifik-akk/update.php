<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KelayakanSukanSpesifikAkk */

$this->title = 'Update Kelayakan Sukan Spesifik Akk: ' . ' ' . $model->kelayakan_sukan_spesifik_akk_id;
$this->params['breadcrumbs'][] = ['label' => 'Kelayakan Sukan Spesifik Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kelayakan_sukan_spesifik_akk_id, 'url' => ['view', 'id' => $model->kelayakan_sukan_spesifik_akk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelayakan-sukan-spesifik-akk-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
