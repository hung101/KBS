<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiOku */

$this->title = 'Update Ref Agensi Oku: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Okus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-agensi-oku-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
