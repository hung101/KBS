<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SoalanPenilaian */

$this->title = $model->soalan_penilaian_id;
$this->params['breadcrumbs'][] = ['label' => 'Soalan Penilaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soalan-penilaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->soalan_penilaian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->soalan_penilaian_id], [
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
            'soalan_penilaian_id',
            'borang_penilaian_id',
            'bahagian',
            'soalan',
            'jawapan',
        ],
    ]) ?>

</div>
