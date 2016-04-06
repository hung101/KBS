<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPermohonan */

$this->title = GeneralLabel::createTitle . ' Lampiran Perbelanjaan/Resit';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lampiran_perbelanjaanresit, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-permohonan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
