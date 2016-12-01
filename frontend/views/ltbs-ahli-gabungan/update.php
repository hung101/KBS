<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliGabungan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_ahli_gabungan.': ' . ' ' . $model->ahli_gabungan_id;
$this->title =  ''.GeneralLabel::senarai_ahli_gabungan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_ahli_gabungan, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $model->profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->ahli_gabungan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-ahli-gabungan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
