<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanDokumenMediaProgram */

$this->title = $model->pengurusan_dokumen_media_program_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Dokumen Media Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-dokumen-media-program-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_dokumen_media_program_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_dokumen_media_program_id], [
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
            'pengurusan_dokumen_media_program_id',
            'pengurusan_media_program_id',
            'kategori_dokumen',
            'nama_dokumen',
            'muatnaik',
        ],
    ])*/ ?>

</div>
