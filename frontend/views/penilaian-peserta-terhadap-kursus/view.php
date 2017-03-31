<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursus */

//$this->title = $model->penilaian_peserta_terhadap_kursus_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_peserta_terhadap_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_peserta_terhadap_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-peserta-terhadap-kursus-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-peserta-terhadap-kursus']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penilaian_peserta_terhadap_kursus_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-peserta-terhadap-kursus']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penilaian_peserta_terhadap_kursus_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-peserta-terhadap-kursus']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->penilaian_peserta_terhadap_kursus_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
        'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penilaian_peserta_terhadap_kursus_id',
            'pengurusan_permohonan_kursus_persatuan_id',
            'tarikh_kursus',
            'nama_penganjur_kursus',
            'kod_kursus',
            'tempat_kursus',
            'nama_penyelaras',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ])*/ ?>

</div>
