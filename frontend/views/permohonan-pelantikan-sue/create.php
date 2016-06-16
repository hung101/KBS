<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPelantikanSue */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_pelantikan_sue;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_pelantikan_sue, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pelantikan-sue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
