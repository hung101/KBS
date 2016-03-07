<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiSukan */

$this->title = 'Update Bsp Prestasi Sukan: ' . ' ' . $model->bsp_prestasi_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Prestasi Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_prestasi_sukan_id, 'url' => ['view', 'id' => $model->bsp_prestasi_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-prestasi-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
