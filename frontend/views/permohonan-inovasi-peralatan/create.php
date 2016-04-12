<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanInovasiPeralatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_projek_inovasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_projek_inovasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-inovasi-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
