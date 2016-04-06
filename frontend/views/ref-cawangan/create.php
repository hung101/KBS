<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefCawangan */

$this->title = GeneralLabel::createTitle.' '.'Ref Cawangan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Cawangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-cawangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
