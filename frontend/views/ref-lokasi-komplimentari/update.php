<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefLokasiKomplimentari */

$this->title = 'Update Ref Lokasi Komplimentari: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Lokasi Komplimentaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-lokasi-komplimentari-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
