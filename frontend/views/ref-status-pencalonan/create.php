<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPencalonan */

$this->title = 'Create Ref Status Pencalonan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Pencalonans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-pencalonan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
