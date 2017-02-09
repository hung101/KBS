<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

$this->title = $model->bsp_perlanjutan_sebab_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutan Sebabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_perlanjutan_sebab_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_perlanjutan_sebab_id], [
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
            'bsp_perlanjutan_sebab_id',
            'bsp_perlanjutan_id',
            'sebab',
        ],
    ]) ?>

</div>
