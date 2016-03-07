<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AkademiAkk */

//$this->title = $model->akademi_akk_id;
$this->title = GeneralLabel::viewTitle . ' AKK';
$this->params['breadcrumbs'][] = ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akademi-akk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->akademi_akk_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->akademi_akk_id], [
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
        'searchModelKegiatanPengalamanJurulatihAkk' => $searchModelKegiatanPengalamanJurulatihAkk,
        'dataProviderKegiatanPengalamanJurulatihAkk' => $dataProviderKegiatanPengalamanJurulatihAkk,
        'searchModelKegiatanPengalamanAtletAkk' => $searchModelKegiatanPengalamanAtletAkk,
        'dataProviderKegiatanPengalamanAtletAkk' => $dataProviderKegiatanPengalamanAtletAkk,
        'searchModelKelayakanAkademiAkk' => $searchModelKelayakanAkademiAkk,
        'dataProviderKelayakanAkademiAkk' => $dataProviderKelayakanAkademiAkk,
        'searchModelKelayakanSukanSpesifikAkk' => $searchModelKelayakanSukanSpesifikAkk,
        'dataProviderKelayakanSukanSpesifikAkk' => $dataProviderKelayakanSukanSpesifikAkk,
        'searchModelPemohonKursusTahapAkk' => $searchModelPemohonKursusTahapAkk,
        'dataProviderPemohonKursusTahapAkk' => $dataProviderPemohonKursusTahapAkk,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'akademi_akk_id',
            'nama',
            'muatnaik_gambar',
            'no_kad_pengenalan',
            'no_passport',
            'tarikh_lahir',
            'tempat_lahir',
            'no_telefon',
            'emel',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'no_telefon_pejabat',
            'kategori_pensijilan',
        ],
    ]);*/ ?>

</div>
