<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidangKepakaranSukarelawan */

$this->title = 'Create Ref Bidang Kepakaran Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bidang Kepakaran Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-kepakaran-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
