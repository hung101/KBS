<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifPersatuan */

$this->title = $model->pembayaran_insentif_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-persatuan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pembayaran_insentif_persatuan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pembayaran_insentif_persatuan_id], [
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
            'pembayaran_insentif_persatuan_id',
            'pembayaran_insentif_id',
            'persatuan',
            'nama_bank',
            'no_akaun_bank',
            'nilai',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
