<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanLain */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_lain;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_lain, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->anugerah_pencalonan_lain_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->anugerah_pencalonan_lain_id], [
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
        'searchModelAnugerahPencalonanLainJawatan' => $searchModelAnugerahPencalonanLainJawatan,
        'dataProviderAnugerahPencalonanLainJawatan' => $dataProviderAnugerahPencalonanLainJawatan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anugerah_pencalonan_lain_id',
            'kategori',
            'nama',
            'gambar',
            'no_kad_pengenalan',
            'no_tel_1',
            'no_tel_2',
            'sumbangan_dalam_pencapaian:ntext',
            'ulasan_justifikasi:ntext',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
