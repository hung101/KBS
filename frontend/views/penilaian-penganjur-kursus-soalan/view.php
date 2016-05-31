<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursusSoalan */

$this->title = $model->penilaian_penganjur_kursus_soalan_id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Penganjur Kursus Soalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-penganjur-kursus-soalan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->penilaian_penganjur_kursus_soalan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->penilaian_penganjur_kursus_soalan_id], [
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
            'penilaian_penganjur_kursus_soalan_id',
            'penilaian_penganjur_kursus_id',
            'kategori_soalan',
            'soalan',
            'skala',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
