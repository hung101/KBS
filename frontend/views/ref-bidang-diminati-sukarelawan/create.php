<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidangDiminatiSukarelawan */

$this->title = GeneralLabel::createTitle.' '.'Ref Bidang Diminati Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bidang Diminati Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-diminati-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
