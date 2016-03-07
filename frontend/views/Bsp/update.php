<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bsp */

$this->title = 'Update Bsp: ' . ' ' . $model->bsp_pemohon_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_pemohon_id, 'url' => ['view', 'id' => $model->bsp_pemohon_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
