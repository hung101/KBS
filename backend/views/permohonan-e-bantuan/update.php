<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuan */

//$this->title = 'Update Permohonan Ebantuan: ' . ' ' . $model->permohonan_e_bantuan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan e-Bantuan';
//$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Bantuan', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan e-Bantuan', 'url' => ['view', 'id' => $model->permohonan_e_bantuan_id]];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonan' => $searchModelPermohonan,
        'dataProviderPermohonan' => $dataProviderPermohonan,
        'searchModelOP' => $searchModelOP,
        'dataProviderOP' => $dataProviderOP,
        'searchModelJawatankuasa' => $searchModelJawatankuasa,
        'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
        'searchModelSAP' => $searchModelSAP,
        'dataProviderSAP' => $dataProviderSAP,
        'searchModelPTL' => $searchModelPTL,
        'dataProviderPTL' => $dataProviderPTL,
        'searchModelAP' => $searchModelAP,
        'dataProviderAP' => $dataProviderAP,
        'readonly' => $readonly,
    ]) ?>

</div>
