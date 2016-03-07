<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */

//$this->title = 'Update Profil Badan Sukan: ' . ' ' . $model->profil_badan_sukan;
$this->title = 'Profil Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Profil Badan Sukan', 'url' => ['index']];
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
