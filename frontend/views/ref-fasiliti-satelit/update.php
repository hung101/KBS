<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefFasilitiSatelit */

$this->title = 'Update Ref Fasiliti Satelit: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Fasiliti Satelits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-fasiliti-satelit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
