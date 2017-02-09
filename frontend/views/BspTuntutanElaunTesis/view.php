<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */

$this->title = $model->bsp_tuntutan_elaun_tesis_od;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Tuntutan Elaun Teses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tuntutan-elaun-tesis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_tuntutan_elaun_tesis_od], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_tuntutan_elaun_tesis_od], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_tuntutan_elaun_tesis_od',
            'bsp_pemohon_id',
            'tarikh',
            'tajuk_tesis',
        ],
    ]) ?>

</div>
