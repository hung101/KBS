<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPakaianPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pakaian_peralatan.': ' . ' ' . $model->peralatan_id;
$this->title = GeneralLabel::updateTitle . ' Peralatan Sukan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peralatan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Peralatan Sukan', 'url' => ['view', 'id' => $model->peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pakaian-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
