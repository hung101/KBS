<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanAnalisiTubuhBadan */

$this->title = $model->keputusan_analisi_tubuh_badan_id;
$this->params['breadcrumbs'][] = ['label' => 'Keputusan Analisi Tubuh Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-analisi-tubuh-badan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->keputusan_analisi_tubuh_badan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->keputusan_analisi_tubuh_badan_id], [
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
            'keputusan_analisi_tubuh_badan_id',
            'perkhidmatan_permakanan_id',
            'kategori_atlet',
            'sukan',
            'acara',
            'atlet',
            'fit',
            'unfit',
            'refer',
        ],
    ]);*/ ?>

</div>
