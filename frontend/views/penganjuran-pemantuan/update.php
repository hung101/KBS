<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranPemantuan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penganjuran_pemantuan.': ' . ' ' . $model->penganjuran_pemantuan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_pemantuans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penganjuran_pemantuan_id, 'url' => ['view', 'id' => $model->penganjuran_pemantuan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penganjuran-pemantuan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
