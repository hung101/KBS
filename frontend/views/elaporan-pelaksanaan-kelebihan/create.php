<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKelebihan */

$this->title = GeneralLabel::createTitle.' '.'Elaporan Pelaksanaan Kelebihan';
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Kelebihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kelebihan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
