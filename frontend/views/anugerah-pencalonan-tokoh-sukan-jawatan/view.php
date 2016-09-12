<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanTokohSukanJawatan */

$this->title = $model->anugerah_pencalonan_lain_jawatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Lain Jawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-jawatan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->anugerah_pencalonan_lain_jawatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->anugerah_pencalonan_lain_jawatan_id], [
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
            'anugerah_pencalonan_lain_jawatan_id',
            'anugerah_pencalonan_lain_id',
            'jawatan',
            'nama_persatuan_pertubuhan',
            'tempoh',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
