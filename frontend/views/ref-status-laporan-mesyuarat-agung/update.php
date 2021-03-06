<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusLaporanMesyuaratAgung */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::status_laporan_mesyuarat_agung.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_laporan_mesyuarat_agung, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-status-laporan-mesyuarat-agung-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
