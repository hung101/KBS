<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikalMonth */

$this->title = 'Update Bsp Elaun Latihan Praktikal Month: ' . ' ' . $model->bsp_elaun_latihan_praktikal_month_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Elaun Latihan Praktikal Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_elaun_latihan_praktikal_month_id, 'url' => ['view', 'id' => $model->bsp_elaun_latihan_praktikal_month_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-elaun-latihan-praktikal-month-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
