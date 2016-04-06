<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */

$this->title = $model->bajet_penyelidikan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bajet_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bajet-penyelidikan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bajet_penyelidikan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bajet_penyelidikan_id], [
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
            'bajet_penyelidikan_id',
            'permohonana_penyelidikan_id',
            'jenis_bajet',
            'tahun_1',
            'jumlah',
        ],
    ]);*/ ?>

</div>
