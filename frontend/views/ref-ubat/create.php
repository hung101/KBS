<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUbat */

$this->title = GeneralLabel::createTitle.' '.'Ref Ubat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Ubats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ubat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
