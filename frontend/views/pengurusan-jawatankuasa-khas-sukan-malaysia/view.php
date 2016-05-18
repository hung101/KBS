<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysia */

$this->title = $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jawatankuasa Khas Sukan Malaysias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_jawatankuasa_khas_sukan_malaysia_id',
            'temasya',
            'tarikh_mula',
            'tarikh_tamat',
            'jawatankuasa',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]) ?>

</div>
