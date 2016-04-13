<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiHargaPerkhidmatanUbatanPeralatan */

//$this->title = $model->senarai_harga_perkhidmatan_ubatan_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::senarai_harga_perkhidmatanubatanperalatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_harga_perkhidmatanubatanperalatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-harga-perkhidmatan-ubatan-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->senarai_harga_perkhidmatan_ubatan_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->senarai_harga_perkhidmatan_ubatan_peralatan_id], [
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
            'senarai_harga_perkhidmatan_ubatan_peralatan_id',
            'nama_perkhidmatan_ubatan_peralatan',
            'harga',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
