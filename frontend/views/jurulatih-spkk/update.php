<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSpkk */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih_spkk.': ' . ' ' . $model->jurulatih_spkk_id;
$this->title = GeneralLabel::updateTitle . ' Kelayakan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kelayakan', 'url' => ['view', 'id' => $model->jurulatih_spkk_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-spkk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
