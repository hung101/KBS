<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliJawatankuasaIndukKecil */

//$this->title = $model->ahli_jawatan_id;
$this->title =  'Ahli Jawatankuasa Induk';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ahli_jawatan_induk_id, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-ahli-jawatankuasa-induk-kecil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['update']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->ahli_jawatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['delete']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->ahli_jawatan_id], [
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
            'ahli_jawatan_id',
            'jenis_jawatankuasa',
            'nama_jawatankuasa',
            'jawatan',
            'nama_penuh',
            'no_kad_pengenalan',
            'jantina',
            'bangsa',
            'umur',
            'pekerjaan',
            'nama_majikan',
            'tarikh_mula_memegang_jawatan',
            'pengiktirafan_yang_diterima',
            'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan',
        ],
    ]);*/ ?>

</div>
