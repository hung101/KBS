<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSemesterTerkini */

$this->title = GeneralLabel::createTitle.' '.'Ref Semester Terkini';
$this->params['breadcrumbs'][] = ['label' => 'Ref Semester Terkinis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-semester-terkini-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
