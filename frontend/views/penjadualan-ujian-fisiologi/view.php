<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenjadualanUjianFisiologi */

//$this->title = $model->penjadualan_ujian_fisiologi_id;
$this->title = GeneralLabel::viewTitle . ' Penjadualan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Penjadualan Ujian Fisiologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penjadualan_ujian_fisiologi_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penjadualan_ujian_fisiologi_id], [
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
            'penjadualan_ujian_fisiologi_id',
            'atlet_id',
            'perkhidmatan',
            'tarikh_masa',
            'pegawai_yang_bertanggungjawab',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
