<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysia */

//$this->title = $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jawatankuasa-khas-sukan-malaysia']['update'])): ?>
            <?= Html::a('Update', ['update', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jawatankuasa-khas-sukan-malaysia']['delete'])): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id], [
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
        'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_jawatankuasa_khas_sukan_malaysia_id',
            'temasya',
            'tarikh_mula',
            'tarikh_tamat',
            'jawatankuasa',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
