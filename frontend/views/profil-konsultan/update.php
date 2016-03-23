<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultan */

//$this->title = 'Update Profil Konsultan: ' . ' ' . $model->profil_konsultan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::profil_kaunselor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_kaunselor, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_kaunselor, 'url' => ['view', 'id' => $model->profil_konsultan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
