<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bsp */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp.': ' . ' ' . $model->bsp_pemohon_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsps, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_pemohon_id, 'url' => ['view', 'id' => $model->bsp_pemohon_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
