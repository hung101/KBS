<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerganjuran */

//$this->title = $model->permohonan_perganjuran_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penganjuran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perganjuran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_perganjuran_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_perganjuran_id], [
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
        'searchModelPermohonanPerganjuranInstructor' => $searchModelPermohonanPerganjuranInstructor,
        'dataProviderPermohonanPerganjuranInstructor' => $dataProviderPermohonanPerganjuranInstructor,
        'searchModelPermohonanPenganjuranKos' => $searchModelPermohonanPenganjuranKos,
        'dataProviderPermohonanPenganjuranKos' => $dataProviderPermohonanPenganjuranKos,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_perganjuran_id',
            'tarikh_kursus',
            'tempat_kursus',
            'aktiviti',
            'nama_instructor',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
