<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUjianStatusBiomekanik */

$this->title = GeneralLabel::createTitle.' '.'Ref Ujian Status Biomekanik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Ujian Status Biomekaniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ujian-status-biomekanik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
