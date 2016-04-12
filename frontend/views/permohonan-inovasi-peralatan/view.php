<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanInovasiPeralatan */

//$this->title = $model->permohonan_inovasi_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_projek_inovasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_projek_inovasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-inovasi-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_inovasi_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_inovasi_peralatan_id], [
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
            'permohonan_inovasi_peralatan_id',
            'tarikh_permohonan',
            'pemohon',
            'nama_peralatan',
            'ringkasan_inovasi_peralatan',
            'pegawai_yang_bertanggungjawab',
            'catitan_ringkas',
            'status_permohonan',
        ],
    ]);*/ ?>

</div>
