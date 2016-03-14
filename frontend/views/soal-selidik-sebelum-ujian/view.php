<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjian */

//$this->title = $model->soal_selidik_sebelum_ujian_id;
$this->title = GeneralLabel::viewTitle . ' Soal Selidik Sebelum Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->soal_selidik_sebelum_ujian_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['delete'])): ?>
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
        'searchModelSoalSelidikSebelumUjianSoalanJawapan' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
        'dataProviderSoalSelidikSebelumUjianSoalanJawapan' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
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
