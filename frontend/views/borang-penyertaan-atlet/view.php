<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenyertaanAtlet */

//$this->title = $model->borang_penyertaan_atlet_id;
$this->title = GeneralLabel::viewTitle . ' Borang Penyertaan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Borang Penyertaan Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penyertaan-atlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penyertaan-atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->borang_penyertaan_atlet_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penyertaan-atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->borang_penyertaan_atlet_id], [
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
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'borang_penyertaan_atlet_id',
            'atlet_id',
            'nama_program',
            'tarikh_program',
        ],
    ])*/ ?>

</div>
