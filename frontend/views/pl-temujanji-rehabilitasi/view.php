<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanjiRehabilitasi */

//$this->title = $model->pl_temujanji_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-rehabilitasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pl_temujanji_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pl_temujanji_id], [
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
        'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
        'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pl_temujanji_id',
            'atlet_id',
            'tarikh_temujanji',
            'doktor_pegawai_perubatan',
            'makmal_perubatan',
            'status_temujanji',
            'pegawai_yang_bertanggungjawab',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
