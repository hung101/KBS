<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_elaun_latihan_praktikal.': ' . ' ' . $model->bsp_elaun_latihan_praktikal_id;
$this->title = GeneralLabel::updateTitle . ' Elaun Latihan Praktikal';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaun_latihan_praktikal, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Elaun Latihan Praktikal', 'url' => ['view', 'id' => $model->bsp_elaun_latihan_praktikal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'readonly' => $readonly,
    ]) ?>

</div>
