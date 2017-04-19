<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefBidangKepakaranSukarelawan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bidang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::acara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-kepakaran-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
