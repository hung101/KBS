<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PinjamanPeralatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pinjaman_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pinjaman_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
