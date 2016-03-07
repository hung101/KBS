<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiAktiviti */

//$this->title = 'Update Psikologi Aktiviti: ' . ' ' . $model->psikologi_aktiviti_id;
$this->title = GeneralLabel::updateTitle . ' Aktiviti Psikologi';
$this->params['breadcrumbs'][] = ['label' => 'Aktiviti Psikologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Aktiviti Psikologi', 'url' => ['view', 'id' => $model->psikologi_aktiviti_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-aktiviti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
