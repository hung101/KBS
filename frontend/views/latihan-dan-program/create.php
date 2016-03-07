<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgram */

$this->title =  'Latihan Dan Pendidikan Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Latihan Dan Pendidikan Badan Sukan', 'url' => ['index']];
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
