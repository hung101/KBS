<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuranSumberKewangan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::paobs_penganjuran_sumber_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::paobs_penganjuran_sumber_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-sumber-kewangan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
