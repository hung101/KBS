<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgram */

$this->title = GeneralLabel::latihan_dan_pendidikan_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::latihan_dan_pendidikan_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="latihan-dan-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPeserta' => $searchModelPeserta,
        'dataProviderPeserta' => $dataProviderPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
