<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuran */

//$this->title = 'Update Paobs Penganjuran: ' . ' ' . $model->penganjuran_id;
$this->title = ' Penganjuran Acara Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Acara Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->penganjuran_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="paobs-penganjuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
        'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
    ]) ?>

</div>
