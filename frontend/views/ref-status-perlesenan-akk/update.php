<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPerlesenanAkk */

$this->title = 'Update Ref Status Perlesenan Akk: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Perlesenan Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-perlesenan-akk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
