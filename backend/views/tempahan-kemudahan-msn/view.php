<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

//$this->title = $model->tempahan_kemudahan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::tempahan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-msn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->tempahan_kemudahan_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->tempahan_kemudahan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
    </p>-->
    
    <p>
        <?= Html::a(GeneralLabel::cetak_borang_tempahan_kemudahan, ['tempahan-kemudahan', 'tempahan_kemudahan_id' => $model->tempahan_kemudahan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
        'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tempahan_kemudahan_id',
            'nama',
            'no_kad_pengenalan',
            'location_alamat_1',
            'venue',
            'tarikh',
            'catatan',
        ],
    ]);*/ ?>

</div>
