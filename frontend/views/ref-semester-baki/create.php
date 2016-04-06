<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSemesterBaki */

$this->title = GeneralLabel::createTitle.' '.'Ref Semester Baki';
$this->params['breadcrumbs'][] = ['label' => 'Ref Semester Bakis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-semester-baki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
