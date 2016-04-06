<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PinjamanPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pinjaman_peralatan.': ' . ' ' . $model->pinjaman_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' Pinjaman Peralatan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pinjaman_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pinjaman Peralatan', 'url' => ['view', 'id' => $model->pinjaman_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
