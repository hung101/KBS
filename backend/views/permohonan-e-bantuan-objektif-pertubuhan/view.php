<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanObjektifPertubuhan */

$this->title = $model->objektif_pertubuhan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Objektif Pertubuhans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-objektif-pertubuhan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->objektif_pertubuhan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->objektif_pertubuhan_id], [
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
            'objektif_pertubuhan_id',
            'permohonan_e_bantuan_id',
            'objektif',
        ],
    ])*/ ?>

</div>
