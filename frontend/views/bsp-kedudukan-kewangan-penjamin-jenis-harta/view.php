<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

//$this->title = $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id;
$this->title = GeneralLabel::viewTitle . ' Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin (Jenis Harta)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_kedudukan_kewangan_penjamin_jenis_harta_id',
            'bsp_kedudukan_kewangan_penjamin_id',
            'jenis_harta',
            'jumlah_ekar_kaki_persegi',
            'nilai',
        ],
    ]);*/ ?>

</div>
