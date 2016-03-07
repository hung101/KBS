<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSaizPakaian */

$this->title = 'Update Ref Saiz Pakaian: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Saiz Pakaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-saiz-pakaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
