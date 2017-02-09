<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegara */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::lawatan_rasmi_luar_negara;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lawatan_rasmi_luar_negara, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::lawatan_rasmi_luar_negara, 'url' => ['view', 'id' => $model->lawatan_rasmi_luar_negara_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawatan-rasmi-luar-negara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
        'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
        'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
        'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
        'readonly' => $readonly,
    ]) ?>

</div>
