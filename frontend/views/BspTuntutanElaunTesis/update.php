<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */

$this->title = 'Update Bsp Tuntutan Elaun Tesis: ' . ' ' . $model->bsp_tuntutan_elaun_tesis_od;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Tuntutan Elaun Teses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_tuntutan_elaun_tesis_od, 'url' => ['view', 'id' => $model->bsp_tuntutan_elaun_tesis_od]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-tuntutan-elaun-tesis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
