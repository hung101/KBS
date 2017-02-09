<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

$this->title = 'Update Bsp Elaun Latihan Praktikal: ' . ' ' . $model->bsp_elaun_latihan_praktikal_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Elaun Latihan Praktikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_elaun_latihan_praktikal_id, 'url' => ['view', 'id' => $model->bsp_elaun_latihan_praktikal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-elaun-latihan-praktikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
