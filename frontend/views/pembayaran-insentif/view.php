<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentif */

//$this->title = $model->pembayaran_insentif_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pembayaran_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->pembayaran_insentif_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pembayaran_insentif_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['delete']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pembayaran_insentif_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['kelulusan']) && $model->hantar_flag == 1): ?>
            <?= Html::a(GeneralLabel::print_jkb, ['print-jkb', 'id' => $model->pembayaran_insentif_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
        'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
        'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
        'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
        'searchModelPembayaranInsentifPersatuan' => $searchModelPembayaranInsentifPersatuan,
        'dataProviderPembayaranInsentifPersatuan' => $dataProviderPembayaranInsentifPersatuan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pembayaran_insentif_id',
            'kejohanan',
            'jenis_insentif',
            'pingat',
            'kumpulan_temasya_kejohanan',
            'rekod_baharu',
            'jumlah',
            'kelulusan',
            'tarikh_kelulusan',
            'tarikh_pembayaran_insentif',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
