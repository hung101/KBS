<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */

//$this->title = 'Update Permohonan Peralatan: ' . ' ' . $model->permohonan_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Peralatan', 'url' => ['view', 'id' => $model->permohonan_peralatan_id]];
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
