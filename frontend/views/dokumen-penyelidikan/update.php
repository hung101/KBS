<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DokumenPenyelidikan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::dokumen_penyelidikan.': ' . ' ' . $model->dokumen_penyelidikan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dokumen_penyelidikan_id, 'url' => ['view', 'id' => $model->dokumen_penyelidikan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dokumen-penyelidikan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
