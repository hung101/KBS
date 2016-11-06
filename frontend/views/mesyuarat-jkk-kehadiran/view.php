<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratJkkKehadiran */

$this->title = $model->senarai_nama_hadir_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_senarai_nama_hadirs, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-jkk-kehadiran-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->senarai_nama_hadir_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->senarai_nama_hadir_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'senarai_nama_hadir_id',
            'mesyuarat_id',
            'nama',
            'kehadiran',
            'emel',
        ],
    ])*/ ?>

</div>
