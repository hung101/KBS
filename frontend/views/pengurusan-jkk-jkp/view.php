<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkp */

//$this->title = $model->pengurusan_jkk_jkp_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jkkjkp;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jkkjkp, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_jkk_jkp_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_jkk_jkp_id], [
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
            'pengurusan_jkk_jkp_id',
            'nama_setiausaha_jkk_jkp',
            'tarikh_pelantikan_jkk_jkp',
            'tempoh_hak_jkk_jkp',
            'status',
            'nama_pegawai_coach',
            'jawatan',
            'tarikh_pelantikan',
            'tempoh_hak',
            'nama_sukan',
            'nama_acara',
            'nama_atlet',
            'status_pilihan',
            'nama_jurulatih',
        ],
    ]);*/ ?>

</div>
