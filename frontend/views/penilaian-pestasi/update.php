<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasi */

//$this->title = 'Update Penilaian Pestasi: ' . ' ' . $model->penilaian_pestasi_id;
$this->title = GeneralLabel::updateTitle . ' Penilaian Pestasi';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Pestasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penilaian Pestasi', 'url' => ['view', 'id' => $model->penilaian_pestasi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-pestasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
