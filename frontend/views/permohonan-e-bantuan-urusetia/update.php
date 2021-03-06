<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_bendahari_ipt.': ' . ' ' . $model->bsp_bendahari_ipt_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::urusetia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::urusetia, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::urusetia, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-e-bantuan-urusetia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
