<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanUpstn */

//$this->title = $model->pengurusan_upstn_id;
$this->title = GeneralLabel::viewTitle . ' USPTN';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_usptn, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-upstn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_upstn_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_upstn_id], [
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
        'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
        'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
        'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
        'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
        'readonly' => $readonly,
    ]) ?>


    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_upstn_id',
            'nama_pengurus_sukan',
            'nama_sukan',
            'tarikh_lawatan',
            'masa',
            'tempat',
            'kehadiran',
            'isu',
            'ulasan',
        ],
    ]);*/ ?>

</div>
