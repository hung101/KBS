<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanUbatan */

//$this->title = $model->farmasi_permohonan_ubatan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_ubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-ubatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->farmasi_permohonan_ubatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->farmasi_permohonan_ubatan_id], [
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
        'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
        'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'farmasi_permohonan_ubatan_id',
            'atlet_id',
            'tarikh_pemberian',
            'pegawai_yang_bertanggungjawab',
            'catitan_ringkas',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
