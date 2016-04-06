<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKekurangan */

$this->title = GeneralLabel::createTitle.' '.'Elaporan Pelaksanaan Kekurangan';
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Kekurangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kekurangan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
