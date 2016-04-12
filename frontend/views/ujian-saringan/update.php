<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::maklumat_bakat.': ' . ' ' . $model->ujian_saringan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::maklumat_bakat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_bakat, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_bakat, 'url' => ['view', 'id' => $model->ujian_saringan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ujian-saringan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
