<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukan */

//$this->title = $model->khidmat_perubatan_dan_sains_sukan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::khidmat_perubatan_dan_sains_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::khidmat_perubatan_dan_sains_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['khidmat-perubatan-dan-sains-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->khidmat_perubatan_dan_sains_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['khidmat-perubatan-dan-sains-sukan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->khidmat_perubatan_dan_sains_sukan_id], [
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
        'searchModelAtlet' => $searchModelAtlet,
        'dataProviderAtlet' => $dataProviderAtlet,
        'searchModelJurulatih' => $searchModelJurulatih,
        'dataProviderJurulatih' => $dataProviderJurulatih,
        'searchModelPegawai' => $searchModelPegawai,
        'dataProviderPegawai' => $dataProviderPegawai,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'khidmat_perubatan_dan_sains_sukan_id',
            'kategori_servis',
            'servis',
            'tempat',
            'tarikh_mula',
            'tarikh_tamat',
            'status',
            'muat_naik',
            'kecederaan_jika_ada',
            'sukan',
            'program',
            'mod_latihan',
            'sasaran',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
