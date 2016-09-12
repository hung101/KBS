<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitBayaran */

$this->title = $model->bantuan_penganjuran_kejohanan_bayaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-bayaran-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id], [
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
            'bantuan_penganjuran_kejohanan_bayaran_id',
            'bantuan_penganjuran_kejohanan_id',
            'jenis_bayaran',
            'lain_lain',
            'jumlah',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
