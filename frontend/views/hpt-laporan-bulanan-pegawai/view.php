<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\HptLaporanBulananPegawai */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::hpt_laporan_bulanan_pegawai;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hpt_laporan_bulanan_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpt-laporan-bulanan-pegawai-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['hpt-laporan-bulanan-pegawai']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->hpt_laporan_bulanan_pegawai_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['hpt-laporan-bulanan-pegawai']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->hpt_laporan_bulanan_pegawai_id], [
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

</div>
