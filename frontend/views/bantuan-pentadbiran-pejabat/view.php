<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPentadbiranPejabat */

//$this->title = $model->bantuan_pentadbiran_pejabat_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_pentadbiran_pejabat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_pentadbiran_pejabat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-pentadbiran-pejabat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->bantuan_pentadbiran_pejabat_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['status_permohonan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_pentadbiran_pejabat_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['delete']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['status_permohonan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_pentadbiran_pejabat_id], [
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
        'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
        'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_pentadbiran_pejabat_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'status_permohonan',
            'catatan',
        ],
    ]);*/ ?>

</div>
