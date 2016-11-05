<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBidangKepakaranSukarelawan */

$this->title = 'Update Ref Bidang Kepakaran Sukarelawan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Bidang Kepakaran Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-bidang-kepakaran-sukarelawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
