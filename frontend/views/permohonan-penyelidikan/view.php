<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan */

//$this->title = $model->permohonana_penyelidikan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penyelidikan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonana_penyelidikan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonana_penyelidikan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->permohonana_penyelidikan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
        'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
        'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
        'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
        'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
        'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
        'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
        'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonana_penyelidikan_id',
            'nama_permohon',
            'tarikh_permohonan',
            'tajuk_penyelidikan',
            'ringkasan_permohonan',
            'biasa_dengan_keperluan_penyelidikan',
            'kelulusan_echics',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
