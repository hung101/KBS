<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkPermitKerja */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::akk_permit_kerja.': ' . ' ' . $model->akk_permit_kerja_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_permit_kerja, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akk_permit_kerja_id, 'url' => ['view', 'id' => $model->akk_permit_kerja_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akk-permit-kerja-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
