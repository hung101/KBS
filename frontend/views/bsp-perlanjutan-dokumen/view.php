<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanDokumen */

$this->title = $model->bsp_perlanjutan_dokumen_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutan Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-dokumen-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_perlanjutan_dokumen_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_perlanjutan_dokumen_id], [
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
            'bsp_perlanjutan_dokumen_id',
            'bsp_perlanjutan_id',
            'nama_dokumen',
            'upload',
        ],
    ]);*/ ?>

</div>
