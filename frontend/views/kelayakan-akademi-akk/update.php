<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KelayakanAkademiAkk */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kelayakan_akademi_akk.': ' . ' ' . $model->kelayakan_akademi_akk_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_akademi_akks, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kelayakan_akademi_akk_id, 'url' => ['view', 'id' => $model->kelayakan_akademi_akk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelayakan-akademi-akk-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
