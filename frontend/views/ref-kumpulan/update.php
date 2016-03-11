<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKumpulan */

$this->title = 'Update Ref Kumpulan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kumpulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kumpulan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
