<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuran */

$this->title = GeneralLabel::penganjuran_acara_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_acara_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="paobs-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
        'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
    ]) ?>

</div>
