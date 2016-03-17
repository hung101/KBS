<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPermohonanKem */

$this->title = $model->borang_permohonan_kem_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Permohonan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-permohonan-kem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->borang_permohonan_kem_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->borang_permohonan_kem_id], [
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
            'borang_permohonan_kem_id',
            'nama_program',
            'tarikh_program',
            'tempat',
            'objektif',
            'cadangan',
        ],
    ]) ?>

</div>
