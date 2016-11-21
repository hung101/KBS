<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTempatKhidmatPerubatan */

$this->title = 'Update Ref Tempat Khidmat Perubatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tempat Khidmat Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tempat-khidmat-perubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
