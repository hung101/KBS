<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RehabilitasiProgram */

$this->title = $model->rehabilitasi_program_id;
$this->params['breadcrumbs'][] = ['label' => 'Rehabilitasi Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rehabilitasi_program_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rehabilitasi_program_id], [
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
            'rehabilitasi_program_id',
            'rehabilitasi_id',
            'tarikh',
            'nama_exercise_modality',
        ],
    ]) ?>

</div>
