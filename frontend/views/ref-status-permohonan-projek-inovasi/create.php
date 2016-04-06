<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanProjekInovasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Projek Inovasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Projek Inovasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-projek-inovasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
