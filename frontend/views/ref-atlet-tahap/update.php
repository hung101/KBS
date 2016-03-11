<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAtletTahap */

$this->title = 'Update Ref Atlet Tahap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Atlet Tahaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-atlet-tahap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
