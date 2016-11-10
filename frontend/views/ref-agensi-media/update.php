<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiMedia */

$this->title = 'Update Agensi Media: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Agensi Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-agensi-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
