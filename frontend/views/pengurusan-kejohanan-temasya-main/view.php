<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKejohananTemasyaMain */

//$this->title = $model->pengurusan_kejohanan_temasya_main_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kejohanan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kejohanan_temasya_main_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kejohanan_temasya_main_id], [
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
        'searchModelPengurusanKejohananTemasya' => $searchModelPengurusanKejohananTemasya,
        'dataProviderPengurusanKejohananTemasya' => $dataProviderPengurusanKejohananTemasya,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_kejohanan_temasya_main_id',
            'nama_temasya',
            'nama_pertandingan',
            'tarikh',
        ],
    ]);*/ ?>

</div>
