<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

//$this->title = $model->bsp_kedudukan_kewangan_penjamin_id;
$this->title = GeneralLabel::viewTitle . ' Kedudukan Kewangan Penjamin';
//$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
        'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_kedudukan_kewangan_penjamin_id',
            'bsp_penjamin_id',
            'pendapatan_bulanan',
            'pinjaman_perumahan_baki_terkini',
            'sebagai_penjamin_siberhutang',
            'lain_lain_pinjaman_tanggungan',
            'perkerjaan',
            'nama_alamat_majikan',
            'nama_isteri_suami',
            'no_kp_isteri_suami',
            'jumlah_anak',
            'pertalian_keluarga_dengan_pelajar',
            'pelajar_lain_selain_daripada_penerima_di_atas',
        ],
    ]);*/ ?>

</div>
