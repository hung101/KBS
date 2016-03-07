<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefCawanganELaporan */

$this->title = 'Update Ref Cawangan Elaporan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Cawangan Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-cawangan-elaporan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
