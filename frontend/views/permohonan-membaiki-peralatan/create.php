<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanMembaikiPeralatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_membaiki_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_membaiki_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-membaiki-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
