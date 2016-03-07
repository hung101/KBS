<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

//$this->title = $model->bsp_penjamin_id;
$this->title = GeneralLabel::viewTitle . ' Penjamin Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Penjamin Biasiswa Sukan Persekutuan', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_penjamin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_penjamin_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_penjamin_id',
            'bsp_pemohon_id',
            'nama',
            'no_kad_pengenalan',
            'alamat_tetap_1',
            'alamat_tetap_2',
            'alamat_tetap_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'alamat_surat_menyurat_1',
            'alamat_surat_menyurat_2',
            'alamat_surat_menyurat_3',
            'alamat_surat_menyurat_negeri',
            'alamat_surat_menyurat_bandar',
            'alamat_surat_menyurat_poskod',
            'no_telefon_rumah',
            'no_telefon_pejabat',
            'no_telefon_bimbit',
            'email:email',
            'alamat_pejabat_1',
            'alamat_pejabat_2',
            'alamat_pejabat_3',
            'alamat_pejabat_negeri',
            'alamat_pejabat_bandar',
            'alamat_pejabat_poskod',
        ],
    ]);*/ ?>

</div>
