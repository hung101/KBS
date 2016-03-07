<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPembayaran */

//$this->title = $model->bsp_pembayaran_id;
$this->title = GeneralLabel::viewTitle . ' Pembayaran Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Biasiswa Sukan Persekutuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pembayaran-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_pembayaran_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_pembayaran_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'bsp_pembayaran_id',
            'bsp_pemohon_id',
            'tarikh',
            'bayaran',
        ],
    ]);*/ ?>

</div>
