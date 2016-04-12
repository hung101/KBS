<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanAnalisaPerlawananBiomekanik */

//$this->title = $model->perkhidmatan_analisa_perlawanan_biomekanik_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::perkhidmatan_analisa_perlawananbiomekanik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_analisa_perlawananbiomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-analisa-perlawanan-biomekanik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id], [
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
        'searchModelBiomekanikUjian' => $searchModelBiomekanikUjian,
        'dataProviderBiomekanikUjian' => $dataProviderBiomekanikUjian,
        'searchModelBiomekanikAnthropometrics' => $searchModelBiomekanikAnthropometrics,
        'dataProviderBiomekanikAnthropometrics' => $dataProviderBiomekanikAnthropometrics,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'perkhidmatan_analisa_perlawanan_biomekanik_id',
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id',
            'perkhidmatan',
            'tarikh',
            'pegawai_yang_bertanggungjawab',
            'status_ujian',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
