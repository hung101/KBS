<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianRekods */

$this->title = $model->pencapaian_rekods_id;
$this->params['breadcrumbs'][] = ['label' => 'Atlet Pencapaian Rekods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-rekods-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pencapaian_rekods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pencapaian_rekods_id], [
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
            'pencapaian_rekods_id',
            'pencapaian_id',
            'tarikh',
            'peringkat',
            'opponent',
            'result',
            'venue',
            'personal_best',
            'season_best',
        ],
    ]);*/ ?>

</div>
