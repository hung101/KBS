<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

//$this->title = $model->bsp_elaun_latihan_praktikal_id;
$this->title = GeneralLabel::viewTitle . ' Elaun Latihan Praktikal';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaun_latihan_praktikal, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_elaun_latihan_praktikal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_elaun_latihan_praktikal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_elaun_latihan_praktikal_id',
            'bsp_pemohon_id',
            'tarikh',
            'jenis_latihan_amali',
            'tempat_latihan_praktikal',
            'tarikh_mula',
            'tarikh_tamat',
            'jumlah_hari',
        ],
    ]);*/ ?>

</div>
