<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanAnalisiTubuhBadan */

$this->title = 'Update Keputusan Analisi Tubuh Badan: ' . ' ' . $model->keputusan_analisi_tubuh_badan_id;
$this->params['breadcrumbs'][] = ['label' => 'Keputusan Analisi Tubuh Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keputusan_analisi_tubuh_badan_id, 'url' => ['view', 'id' => $model->keputusan_analisi_tubuh_badan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keputusan-analisi-tubuh-badan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
