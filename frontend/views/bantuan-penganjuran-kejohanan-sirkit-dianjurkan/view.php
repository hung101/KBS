<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitDianjurkan */

$this->title = $model->bantuan_penganjuran_kejohanan_dianjurkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Dianjurkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-dianjurkan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'bantuan_penganjuran_kejohanan_dianjurkan_id',
            'bantuan_penganjuran_kejohanan_id',
            'kejohanan',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'peringkat_penganjuran',
            'jumlah',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
