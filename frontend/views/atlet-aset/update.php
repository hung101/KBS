<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletAset */

//$this->title = 'Update Atlet Aset: ' . ' ' . $model->aset_id;
$this->title = 'Update Aset';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Asets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aset_id, 'url' => ['view', 'id' => $model->aset_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-aset-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
