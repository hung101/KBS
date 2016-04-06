<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliJawatankuasaKecil */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_ahli_jawatankuasa_kecil__biro_.': ' . ' ' . $model->ahli_jawatan_id;
$this->title =  'Ahli Jawatankuasa Kecil / Biro ';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ahli_jawatankuasa_kecil_biro_, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $model->profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->ahli_jawatan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-ahli-jawatankuasa-kecil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
