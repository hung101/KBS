<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiTugas */

$this->title = $model->senarai_tugas_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_senarai_tugas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-tugas-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->senarai_tugas_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->senarai_tugas_id], [
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
            'senarai_tugas_id',
            'mesyuarat_id',
            'name_tugas',
            'tarikh_tamat',
            'pegawai',
            'atlet_id',
            'persatuan',
            'status',
        ],
    ])*/ ?>

</div>
