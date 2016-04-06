<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanDoktor */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_perubatan_doktor.': ' . ' ' . $model->doktor_id;
$this->title = GeneralLabel::updateTitle . ' Doktor Peribadi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::doktor_peribadi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doktor_id, 'url' => ['view', 'id' => $model->doktor_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-doktor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
