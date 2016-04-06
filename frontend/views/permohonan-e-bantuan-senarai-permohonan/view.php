<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiPermohonan */

$this->title = $model->senarai_permohonan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_senarai_permohonans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-permohonan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->senarai_permohonan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->senarai_permohonan_id], [
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
            'senarai_permohonan_id',
            'permohonan_e_bantuan_id',
            'nama_program',
            'tahun',
            'jumlah_kelulusan',
            'penghantaran_laporan',
        ],
    ])*/ ?>

</div>
