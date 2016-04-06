<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PinjamanPeralatan */

//$this->title = $model->pinjaman_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' Pinjaman Peralatan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pinjaman_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pinjaman_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pinjaman_peralatan_id], [
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
            'pinjaman_peralatan_id',
            'atlet_id',
            'nama_peralatan',
            'kuantiti',
            'tarikh_diberi',
            'tarikh_dipulang',
            'tempoh_pinjaman',
        ],
    ]);*/ ?>

</div>
