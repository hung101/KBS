<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */

$this->title = $model->senarai_aktiviti_projek_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Senarai Aktiviti Projeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->senarai_aktiviti_projek_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->senarai_aktiviti_projek_id], [
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
            'senarai_aktiviti_projek_id',
            'permohonan_e_bantuan_id',
            'nama_aktiviti_projek',
            'keterangan_ringkas',
            'kejayaan_yang_dicapai',
        ],
    ]) ?>

</div>
