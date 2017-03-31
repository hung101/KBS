<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SkimKebajikan */

//$this->title = $model->skim_kebajikan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_skim_kebajikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_skim_kebajikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skim-kebajikan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->skim_kebajikan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->skim_kebajikan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['update'])): ?>
            <?= Html::a(GeneralLabel::print_jkb, ['print-jkb', 'id' => $model->skim_kebajikan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
		<?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'skim_kebajikan_id',
            'jenis_bantuan_skak',
            'jumlah_bantuan',
            'nama_pemohon',
            'nama_penerima',
            'jenis_sukan',
            'masalah_dihadapi',
            'tarikh_kejadian',
            'lokasi_kejadian',
            'jenis_bantuan_lain_yang_diterima',
            'kelulusan',
        ],
    ])*/ ?>

</div>
