<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKelebihan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::elaporan_pelaksanaan_kelebihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_kelebihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kelebihan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
