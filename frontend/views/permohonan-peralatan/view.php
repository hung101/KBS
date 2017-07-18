<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */

//$this->title = $model->permohonan_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->permohonan_peralatan_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['delete']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_peralatan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['update']) && $model->hantar_flag == 1): ?>
            <?= Html::a(GeneralLabel::permohonan_penerimaan_peralatan, ['print-permohonan-penerimaan-peralatan', 'id' => $model->permohonan_peralatan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
            <?= Html::a(GeneralLabel::borang_jkb, ['print-jkb', 'id' => $model->permohonan_peralatan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'searchModelPermohonanPeralatanPenggunaan' => $searchModelPermohonanPeralatanPenggunaan,
        'dataProviderPermohonanPeralatanPenggunaan' => $dataProviderPermohonanPeralatanPenggunaan,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_peralatan_id',
            'cawangan',
            'negeri',
            'sukan',
            'program',
            'tarikh',
            'aktiviti',
            'jumlah_peralatan',
            'nota_urus_setia',
            'kelulusan',
        ],
    ])*/ ?>

</div>
