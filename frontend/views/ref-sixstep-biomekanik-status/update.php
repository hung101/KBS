<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepBiomekanikStatus */

$this->title = 'Update Ref Sixstep Biomekanik Status: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Biomekanik Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sixstep-biomekanik-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
