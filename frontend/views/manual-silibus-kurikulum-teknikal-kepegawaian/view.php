<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ManualSilibusKurikulumTeknikalKepegawaian */

$this->title = $model->manual_silibus_kurikulum_teknikal_kepegawaian_id;
$this->params['breadcrumbs'][] = ['label' => 'Manual Silibus Kurikulum Teknikal Kepegawaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id], [
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
            'manual_silibus_kurikulum_teknikal_kepegawaian_id',
            'persatuan_sukan',
            'jilid_versi',
            'tarikh',
            'muat_naik',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
