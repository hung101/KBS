<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKpi */

//$this->title = $model->pengurusan_kpi_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kpi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kpi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kpi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kpi']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kpi_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kpi']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kpi_id], [
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
            'pengurusan_kpi_id',
            'nama_sukan',
            'nama_acara',
            'jumlah_sasaran_pingat',
            'jumlah_pingat_yang_telah_dimenangi',
            'rekod_baru_yang_dicipta',
            'senarai_atlet_yang_memenangi',
        ],
    ]);*/ ?>

</div>
