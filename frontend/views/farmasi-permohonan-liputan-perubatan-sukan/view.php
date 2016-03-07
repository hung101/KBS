<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanLiputanPerubatanSukan */

//$this->title = $model->permohonan_liputan_perubatan_sukan_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Liputan Perubatan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Liputan Perubatan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-liputan-perubatan-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_liputan_perubatan_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_liputan_perubatan_sukan_id], [
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
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_liputan_perubatan_sukan_id',
            'nama_program',
            'tarikh_program',
            'tempat_program',
            'nama_pemohon',
            'no_tel_pemohon',
            'pegawai_bertugas',
            'muat_naik',
            'kelulusan_ceo',
            'kelulusan_pbu',
        ],
    ]);*/ ?>

</div>
