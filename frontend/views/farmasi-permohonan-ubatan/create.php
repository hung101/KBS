<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanUbatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_ubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-ubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
        'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
        'readonly' => $readonly,
    ]) ?>

</div>
