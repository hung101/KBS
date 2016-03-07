<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

//$this->title = $model->bsp_prestasi_akademik_id;
$this->title = GeneralLabel::viewTitle . ' Prestasi Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Biasiswa', 'url' => ['permohonan-e-biasiswa/view', 'id' => $model->bsp_pemohon_id]];
$this->params['breadcrumbs'][] = ['label' => 'Prestasi Akademik', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_prestasi_akademik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_prestasi_akademik_id], [
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
            'bsp_prestasi_akademik_id',
            'bsp_pemohon_id',
            'tarikh',
            'png',
            'pngk',
        ],
    ]);*/ ?>

</div>
