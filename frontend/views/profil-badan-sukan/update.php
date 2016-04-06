<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::profil_badan_sukan.': ' . ' ' . $model->profil_badan_sukan;
$this->title = GeneralLabel::profil_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->profil_badan_sukan]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="profil-badan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
