<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianHpt */

//$this->title = $model->soal_selidik_sebelum_ujian_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::soal_selidik_sebelum_ujian_hpt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soal_selidik_sebelum_ujian_hpt, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-hpt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian-hpt']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->soal_selidik_sebelum_ujian_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian-hpt']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->soal_selidik_sebelum_ujian_id], [
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
        'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
        'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'soal_selidik_sebelum_ujian_id',
            'atlet_id',
            'tarikh',
            'soalan',
            'jawapan',
        ],
    ]);*/ ?>

</div>
