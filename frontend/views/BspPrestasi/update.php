<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasi */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_prestasi.': ' . ' ' . $model->bsp_prestasi_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_prestasis, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_prestasi_id, 'url' => ['view', 'id' => $model->bsp_prestasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-prestasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
