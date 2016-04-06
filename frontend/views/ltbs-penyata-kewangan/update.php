<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsPenyataKewangan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_penyata_kewangan.': ' . ' ' . $model->penyata_kewangan_id;
$this->title = GeneralLabel::penyata_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyata_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->penyata_kewangan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-penyata-kewangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
