<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */

//$this->title = $model->permohonan_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_peralatan_id], [
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
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_peralatan_id',
            'cawangan',
            'negeri',
            'sukan',
            'program',
            'tarikh',
            'aktiviti',
            'jumlah_peralatan',
            'nota_urus_setia',
            'kelulusan',
        ],
    ])*/ ?>

</div>
