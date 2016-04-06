<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiPermohonan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_senarai_permohonan.': ' . ' ' . $model->senarai_permohonan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_senarai_permohonans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_permohonan_id, 'url' => ['view', 'id' => $model->senarai_permohonan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-senarai-permohonan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
