<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

//$this->title = 'Update Bsp Bendahari Ipt: ' . ' ' . $model->bsp_bendahari_ipt_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bendahari_ipt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bendahari_ipt, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bendahari_ipt, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-bendahari-ipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
