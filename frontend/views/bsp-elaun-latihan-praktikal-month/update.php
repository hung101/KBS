<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikalMonth */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_elaun_latihan_praktikal_month.': ' . ' ' . $model->bsp_elaun_latihan_praktikal_month_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_elaun_latihan_praktikal_months, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_elaun_latihan_praktikal_month_id, 'url' => ['view', 'id' => $model->bsp_elaun_latihan_praktikal_month_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-elaun-latihan-praktikal-month-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
