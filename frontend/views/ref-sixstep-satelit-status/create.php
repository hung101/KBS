<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSatelitStatus */

$this->title = 'Create Ref Sixstep Satelit Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Satelit Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-satelit-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
