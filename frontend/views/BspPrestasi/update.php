<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasi */

$this->title = 'Update Bsp Prestasi: ' . ' ' . $model->bsp_prestasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Prestasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_prestasi_id, 'url' => ['view', 'id' => $model->bsp_prestasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-prestasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
