<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

//$this->title = $model->bsp_elaun_perjalanan_udara_id;
$this->title = GeneralLabel::viewTitle . ' Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Perjalanan Udara', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_elaun_perjalanan_udara_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_elaun_perjalanan_udara_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_elaun_perjalanan_udara_id',
            'bsp_pemohon_id',
            'tarikh',
            'destinasi_pergi',
            'tarikh_pergi',
            'destinasi_balik',
            'tarikh_balik',
        ],
    ]);*/ ?>

</div>
