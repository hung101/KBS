<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsPenyataKewangan */

//$this->title = 'Update Ltbs Penyata Kewangan: ' . ' ' . $model->penyata_kewangan_id;
$this->title = 'Penyata Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Penyata Kewangan', 'url' => ['index']];
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
