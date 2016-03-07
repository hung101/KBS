<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsNotisAgm */

//$this->title = 'Update Ltbs Notis Agm: ' . ' ' . $model->tbl_ltbs_id;
$this->title = 'Notis Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Notis Mesyuarat Agong', 'url' => ['index']];
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
