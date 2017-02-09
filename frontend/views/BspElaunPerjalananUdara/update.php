<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

$this->title = 'Update Bsp Elaun Perjalanan Udara: ' . ' ' . $model->bsp_elaun_perjalanan_udara_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Elaun Perjalanan Udaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_elaun_perjalanan_udara_id, 'url' => ['view', 'id' => $model->bsp_elaun_perjalanan_udara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-elaun-perjalanan-udara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
