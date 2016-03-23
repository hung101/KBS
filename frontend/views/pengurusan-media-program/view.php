<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgram */

//$this->title = $model->pengurusan_media_program_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_media;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_media, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-media-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_media_program_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_media_program_id], [
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
        'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
        'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
        'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
        'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_media_program_id',
            'tarikh',
            'nama_program',
            'tempat',
            'cawangan',
            'maklumat_msn_negeri',
            'catatan',
        ],
    ]);*/ ?>

</div>
