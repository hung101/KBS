<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPerbelanjaan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::perbelanjaan_penyertaan_sukan.': ' . ' ' . $model->penyertaan_sukan_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perbelanjaan_penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_sukan_perbelanjaan_id, 'url' => ['view', 'id' => $model->penyertaan_sukan_perbelanjaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-perbelanjaan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
