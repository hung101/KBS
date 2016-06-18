<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventori */

$this->title = $model->inventori_id;
$this->params['breadcrumbs'][] = ['label' => 'Inventoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->inventori_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->inventori_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inventori_id',
            'tarikh',
            'program',
            'sukan',
            'no_co',
            'alamat_pembekal_1',
            'alamat_pembekal_2',
            'alamat_pembekal_3',
            'alamat_pembekal_negeri',
            'alamat_pembekal_bandar',
            'alamat_pembekal_poskod',
            'perkara:ntext',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
