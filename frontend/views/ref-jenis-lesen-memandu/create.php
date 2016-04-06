<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLesenMemandu */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_lesen_memandu;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_lesen_memandu, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-lesen-memandu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
