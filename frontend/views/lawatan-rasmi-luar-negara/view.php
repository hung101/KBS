<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegara */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::lawatan_rasmi_luar_negara;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lawatan_rasmi_luar_negara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawatan-rasmi-luar-negara-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['lawatan-rasmi-luar-negara']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->lawatan_rasmi_luar_negara_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['lawatan-rasmi-luar-negara']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->lawatan_rasmi_luar_negara_id], [
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
        'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
        'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
        'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
        'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'lawatan_rasmi_luar_negara_id',
            'lawatan',
            'negara',
            'tarikh',
            'delegasi:ntext',
            'jumlah_delegasi',
            'nama_pegawai_terlibat:ntext',
            'catatan:ntext',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ])*/ ?>

</div>
