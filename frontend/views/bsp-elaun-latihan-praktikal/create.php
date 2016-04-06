<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

$this->title = GeneralLabel::createTitle . ' Elaun Latihan Praktikal';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaun_latihan_praktikal, 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'readonly' => $readonly,
    ]) ?>

</div>
