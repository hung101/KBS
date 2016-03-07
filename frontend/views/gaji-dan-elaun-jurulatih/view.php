<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */

//$this->title = $model->gaji_dan_elaun_jurulatih_id;
$this->title = GeneralLabel::viewTitle . ' Gaji Dan Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Gaji Dan Elaun Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-dan-elaun-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->gaji_dan_elaun_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->gaji_dan_elaun_jurulatih_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
        'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gaji_dan_elaun_jurulatih_id',
            'nama_jurulatih',
            'no_kad_pengenalan',
            'no_passport',
            'nama_sukan',
            'tempoh_bayaran',
            'bank',
            'no_akaun',
            'cawangan',
            'catatan',
        ],
    ]);*/ ?>

</div>
