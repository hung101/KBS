<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\JenisKebajikan */

//$this->title = $model->jenis_kebajikan_id;
$this->title = GeneralLabel::viewTitle . ' Jenis Kebajikan';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Kebajikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kebajikan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->jenis_kebajikan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->jenis_kebajikan_id], [
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
            'jenis_kebajikan_id',
            'jenis_kebajikan',
            'perkara',
            'sukan_sea_para_asean',
            'sukan_asia_komenwel_para_asia_ead',
            'sukan_olimpik_paralimpik',
            'kejohanan_asia_dunia',
        ],
    ])*/ ?>

</div>
