<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKehadiranMediaProgram */

$this->title = $model->pengurusan_kehadiran_media_program_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kehadiran_media_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kehadiran-media-program-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_kehadiran_media_program_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_kehadiran_media_program_id], [
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
            'pengurusan_kehadiran_media_program_id',
            'pengurusan_media_program_id',
            'program',
            'nama_wartawan',
            'emel',
            'agensi',
            'no_telefon',
        ],
    ]);*/ ?>

</div>
