<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiProfil */

//$this->title = 'Update Psikologi Profil: ' . ' ' . $model->psikologi_profil_id;
$this->title = GeneralLabel::updateTitle . ' Profil Psikologi';
$this->params['breadcrumbs'][] = ['label' => 'Profil Psikologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Profil Psikologi', 'url' => ['view', 'id' => $model->psikologi_profil_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
