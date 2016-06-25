<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukan */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_pasukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_pasukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-pasukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->anugerah_pencalonan_pasukan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->anugerah_pencalonan_pasukan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
        'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anugerah_pencalonan_pasukan_id',
            'kategori',
            'sukan',
            'nama_pasukan',
            'gambar_pasukan',
            'ulasan_pencapaian',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
