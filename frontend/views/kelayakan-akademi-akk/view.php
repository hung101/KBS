<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KelayakanAkademiAkk */

$this->title = $model->kelayakan_akademi_akk_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_akademi_akks, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-akademi-akk-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kelayakan_akademi_akk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kelayakan_akademi_akk_id], [
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
            'kelayakan_akademi_akk_id',
            'akademi_akk_id',
            'nama_peperiksaan',
            'tahun',
            'keputusan',
        ],
    ]);*/ ?>

</div>
