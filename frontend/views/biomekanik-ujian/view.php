<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikUjian */

$this->title = $model->biomekanik_ujian_id;
$this->params['breadcrumbs'][] = ['label' => 'Biomekanik Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-ujian-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->biomekanik_ujian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->biomekanik_ujian_id], [
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
            'biomekanik_ujian_id',
            'perkhidmatan_biomekanik_id',
            'tarikh',
            'biomekanik_ujian',
        ],
    ]);*/ ?>

</div>
