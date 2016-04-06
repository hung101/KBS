<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_peralatan.': ' . ' ' . $model->permohonan_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_peralatan, 'url' => ['view', 'id' => $model->permohonan_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
