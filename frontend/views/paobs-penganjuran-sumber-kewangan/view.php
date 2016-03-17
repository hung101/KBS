<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuranSumberKewangan */

$this->title = $model->paobs_penganjuran_sumber_kewangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Paobs Penganjuran Sumber Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-sumber-kewangan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->paobs_penganjuran_sumber_kewangan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->paobs_penganjuran_sumber_kewangan_id], [
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
            'paobs_penganjuran_sumber_kewangan_id',
            'penganjuran_id',
            'sumber',
            'jumlah',
            'session_id',

        ],
    ]);*/ ?>

</div>
