<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Ebiasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
