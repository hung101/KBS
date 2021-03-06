<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlSejarahPerubatan */

$this->title = $model->pl_sejarah_perubatan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pl_sejarah_perubatans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-sejarah-perubatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pl_sejarah_perubatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pl_sejarah_perubatan_id], [
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
            'pl_sejarah_perubatan_id',
            'atlet_id',
            'tarikh',
            'nama_perubatan',
            'butiran_perubatan',
        ],
    ]) ?>

</div>
