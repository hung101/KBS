<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaian */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pencapaian.': ' . ' ' . $model->pencapaian_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::pencapaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pencapaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::pencapaian, 'url' => ['view', 'id' => $model->pencapaian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelRekods' => $searchModelRekods,
        'dataProviderRekods' => $dataProviderRekods,
        'readonly' => $readonly,
    ]) ?>

</div>
