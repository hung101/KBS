<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanEBantuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_ebantuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_ebantuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
