<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBiasiswa */

//$this->title = $model->permohonan_biasiswa_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_biasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_biasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-biasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-biasiswa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_biasiswa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-biasiswa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_biasiswa_id], [
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
            'permohonan_biasiswa_id',
            'atlet_id',
            'no_ic',
            'umur',
            'jantina',
            'alamat_rumah_1',
            'alamat_rumah_2',
            'alamat_rumah_3',
            'alamat_rumah_negeri',
            'alamat_rumah_bandar',
            'alamat_rumah_poskod',
            'no_tel_rumah',
            'no_tel_bimbit',
            'alamat_pengajian_1',
            'alamat_pengajian_2',
            'alamat_pengajian_3',
            'alamat_pengajian_negeri',
            'alamat_pengajian_bandar',
            'alamat_pengajian_poskod',
            'no_tel_pengajian',
            'no_fax_pengajian',
            'jenis_biasiswa',
            'muatnaik',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
