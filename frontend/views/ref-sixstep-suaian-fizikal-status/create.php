<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSuaianFizikalStatus */

$this->title = 'Create Ref Sixstep Suaian Fizikal Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Suaian Fizikal Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-suaian-fizikal-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
