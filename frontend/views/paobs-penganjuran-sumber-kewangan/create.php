<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuranSumberKewangan */

$this->title = GeneralLabel::createTitle.' '.'Paobs Penganjuran Sumber Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Paobs Penganjuran Sumber Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-sumber-kewangan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
