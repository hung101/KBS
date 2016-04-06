<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiProfil */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::psikologi_profil.': ' . ' ' . $model->psikologi_profil_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::profil_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_psikologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_psikologi, 'url' => ['view', 'id' => $model->psikologi_profil_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
