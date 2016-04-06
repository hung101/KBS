<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusLaporanMesyuaratAgung */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_laporan_mesyuarat_agung;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_laporan_mesyuarat_agung, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-laporan-mesyuarat-agung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
