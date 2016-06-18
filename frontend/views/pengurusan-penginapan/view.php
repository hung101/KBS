<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenginapan */

//$this->title = $model->pengurusan_penginapan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_penginapan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penginapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penginapan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penginapan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_penginapan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penginapan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_penginapan_id], [
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
        'searchModelPengurusanPenginapanAtlet' => $searchModelPengurusanPenginapanAtlet,
        'dataProviderPengurusanPenginapanAtlet' => $dataProviderPengurusanPenginapanAtlet,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_penginapan_id',
            'atlet_id',
            'nama_pegawai',
            'tarikh_masa_penginapan_mula',
            'tarikh_masa_penginapan_akhir',
            'lokasi',
            'nama_penginapan',
        ],
    ]);*/ ?>

</div>
