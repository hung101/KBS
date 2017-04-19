<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
/* @var $this yii\web\View */
/* @var $model app\models\RefTempatJkk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat." JKK", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-jkk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'desc',
            //'aktif',
            [
                'attribute' => 'aktif',
                'value' => $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no,
            ], 
        ],
    ]) ?>

</div>
