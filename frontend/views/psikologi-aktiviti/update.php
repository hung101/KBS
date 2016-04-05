<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiAktiviti */

//$this->title = 'Update Psikologi Aktiviti: ' . ' ' . $model->psikologi_aktiviti_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::aktiviti_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::aktiviti_psikologi, 'url' => ['index', 'psikologi_profil_id' => $model->psikologi_profil_id]];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::aktiviti_psikologi, 'url' => ['view', 'id' => $model->psikologi_aktiviti_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-aktiviti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
