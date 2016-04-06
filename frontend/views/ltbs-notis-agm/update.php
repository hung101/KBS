<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsNotisAgm */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_notis_agm.': ' . ' ' . $model->tbl_ltbs_id;
$this->title = GeneralLabel::notis_mesyuarat_agong;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::notis_mesyuarat_agong, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->tbl_ltbs_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-notis-agm-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
