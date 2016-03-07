<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rehabilitasi */

$this->title = 'Update Rehabilitasi: ' . ' ' . $model->rehabilitasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rehabilitasi_id, 'url' => ['view', 'id' => $model->rehabilitasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
