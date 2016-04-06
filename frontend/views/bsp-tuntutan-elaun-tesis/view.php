<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */

//$this->title = $model->bsp_tuntutan_elaun_tesis_od;
$this->title = GeneralLabel::viewTitle . ' Tuntutan Elaun Tesis';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tuntutan_elaun_tesis, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tuntutan-elaun-tesis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_tuntutan_elaun_tesis_od], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_tuntutan_elaun_tesis_od], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'bsp_tuntutan_elaun_tesis_od',
            'bsp_pemohon_id',
            'tarikh',
            'tajuk_tesis',
        ],
    ]);*/ ?>

</div>
