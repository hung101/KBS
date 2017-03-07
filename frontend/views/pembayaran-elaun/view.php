<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaun */

//$this->title = $model->pembayaran_elaun_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pembayaran_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-elaun-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pembayaran_elaun_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pembayaran_elaun_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPembayaranElaunTransaksi' => $searchModelPembayaranElaunTransaksi,
        'dataProviderPembayaranElaunTransaksi' => $dataProviderPembayaranElaunTransaksi,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pembayaran_elaun_id',
            'jenis_atlet',
            'atlet_id',
            'kategori_elaun',
            'tempoh_elaun',
            'sebab_elaun',
            'jumlah_elaun',
            'kelulusan',
        ],
    ])*/ ?>

</div>
