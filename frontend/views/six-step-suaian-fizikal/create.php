<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SixStepSuaianFizikal */

$this->title = GeneralLabel::createTitle . ' Six Step';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::suaian_fizikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="six-step-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
