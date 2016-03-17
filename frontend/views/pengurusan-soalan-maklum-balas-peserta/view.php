<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanMaklumBalasPeserta */

$this->title = $model->pengurusan_soalan_maklum_balas_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Soalan Maklum Balas Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-maklum-balas-peserta-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_soalan_maklum_balas_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_soalan_maklum_balas_peserta_id], [
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
            'pengurusan_soalan_maklum_balas_peserta_id',
            'pengurusan_maklum_balas_peserta_id',
            'soalan',
            'rating',
        ],
    ]);*/ ?>

</div>
