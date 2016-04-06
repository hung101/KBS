<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik */

//$this->title = $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Perkhidmatan Analisa Perlawanan Dan Biomekanik';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_biomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id], [
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
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id',
            'atlet_id',
            'tarikh',
            'sukan',
            'tujuan',
            'perkhidmatan',
        ],
    ]);*/ ?>

</div>
