<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanKesihatan */

//$this->title = $model->permohonan_program_pendidikan_kesihatan_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Program Pendidikan Kesihatan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Program Pendidikan Kesihatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-kesihatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_program_pendidikan_kesihatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_program_pendidikan_kesihatan_id], [
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
            'permohonan_program_pendidikan_kesihatan_id',
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
