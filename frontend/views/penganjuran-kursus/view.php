<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursus */

//$this->title = $model->penganjuran_kursus_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::penganjuran_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penganjuran_kursus_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penganjuran_kursus_id], [
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
            'penganjuran_kursus_id',
            'tarikh_kursus_mula',
            'tempat_kursus',
            'negeri',
            'nama_penyelaras',
            'no_telefon',
            'kuota_kursus',
        ],
    ]);*/ ?>

</div>
