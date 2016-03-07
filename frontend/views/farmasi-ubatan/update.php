<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiUbatan */

$this->title = 'Update Farmasi Ubatan: ' . ' ' . $model->farmasi_ubatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Farmasi Ubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->farmasi_ubatan_id, 'url' => ['view', 'id' => $model->farmasi_ubatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="farmasi-ubatan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
