<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$this->title = 'Update Atlet: ' . ' ' . $model->atlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->atlet_id, 'url' => ['view', 'id' => $model->atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => false,
    ]) ?>

</div>
