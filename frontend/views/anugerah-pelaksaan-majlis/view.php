<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPelaksaanMajlis */

//$this->title = $model->anugerah_pelaksaan_majlis_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pelaksaan_majlis;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pelaksaan_majlis, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pelaksaan-majlis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->anugerah_pelaksaan_majlis_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->anugerah_pelaksaan_majlis_id], [
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
            'anugerah_pelaksaan_majlis_id',
            'tarikh_majlis_anugerah',
            'nama_ahli_jawatan_kuasa',
            'jawatan',
            'tarikh_pelantikan',
            'tempoh',
            'nama_tugas',
            'status_tugas',
        ],
    ]);*/ ?>

</div>
