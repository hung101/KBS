<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKekurangan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::elaporan_pelaksanaan_kekurangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_kekurangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kekurangan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
