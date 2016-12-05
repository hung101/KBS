<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSumberKewangan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_sumber_kewangan.': ' . ' ' . $model->sumber_kewangan_id;
$this->title =  GeneralLabel::sumber_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sumber_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->sumber_kewangan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-sumber-kewangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
