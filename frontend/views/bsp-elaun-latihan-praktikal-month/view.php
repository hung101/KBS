<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikalMonth */

$this->title = $model->bsp_elaun_latihan_praktikal_month_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_elaun_latihan_praktikal_months, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-month-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_elaun_latihan_praktikal_month_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_elaun_latihan_praktikal_month_id], [
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
            'bsp_elaun_latihan_praktikal_month_id',
            'bsp_elaun_latihan_praktikal_id',
            'bulan',
            'jumlah_hari',
        ],
    ]);*/ ?>

</div>
