<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliJawatankuasaIndukKecil */

//$this->title = 'Update Ltbs Ahli Jawatankuasa Induk Kecil: ' . ' ' . $model->ahli_jawatan_id;
$this->title =  'Ahli Jawatankuasa Induk';
$this->params['breadcrumbs'][] = ['label' => 'Ahli Jawatankuasa Induk', 'url' => Url::to(['index', 'profil_badan_sukan_id' => $model->profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->ahli_jawatan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-ahli-jawatankuasa-induk-kecil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
