<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAduan */

//$this->title = $model->penyertaan_sukan_aduan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::aduan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::aduan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-aduan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penyertaan_sukan_aduan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penyertaan_sukan_aduan_id], [
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
            'penyertaan_sukan_aduan_id',
            'nama_pengadu',
            'tarikh_aduan',
            'status_aduan',
            'aduan_kategori',
            'penyataan_aduan',
        ],
    ]);*/ ?>

</div>
