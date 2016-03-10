<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefUjianStatusBiomekanik */

$this->title = 'Update Ref Ujian Status Biomekanik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Ujian Status Biomekaniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-ujian-status-biomekanik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
