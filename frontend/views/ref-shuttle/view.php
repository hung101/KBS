<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\RefShuttle */

//$this->title = $model->id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_pemandu;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_pemandu, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-shuttle-view">

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
            // 'id',
            'desc',
			'phoneno',
            //'aktif',
            [
                'attribute' => 'aktif',
                'value' => $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no,
            ],
        ],
    ]) ?>

</div>
