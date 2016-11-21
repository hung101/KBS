<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanJurulatih */

$this->title = $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-jurulatih-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id], [
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
            'khidmat_perubatan_dan_sains_sukan_jurulatih_id',
            'khidmat_perubatan_dan_sains_sukan_id',
            'program',
            'sukan',
            'jurulatih',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
