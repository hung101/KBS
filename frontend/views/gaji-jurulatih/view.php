<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GajiJurulatih */

$this->title = $model->gaji_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Gaji Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-jurulatih-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gaji_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gaji_jurulatih_id], [
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
            'gaji_jurulatih_id',
            'gaji_dan_elaun_jurulatih_id',
            'jumlah',
            'tarikh_mula',
            'tarikh_tamat',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
