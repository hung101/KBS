<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkpProgram */

//$this->title = $model->pengurusan_jkk_jkp_program_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jkkjkp_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jkkjkp_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-program-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-program']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_jkk_jkp_program_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-program']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_jkk_jkp_program_id], [
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
        'searchModelSenaraiAtlet' => $searchModelSenaraiAtlet,
        'dataProviderSenaraiAtlet' => $dataProviderSenaraiAtlet,
        'searchModelSenaraiJurulatih' => $searchModelSenaraiJurulatih,
        'dataProviderSenaraiJurulatih' => $dataProviderSenaraiJurulatih,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_jkk_jkp_program_id',
            'pengurusan_jkk_jkp_id',
            'tarikh_program',
            'kategori_program',
            'nama_program',
            'nama_pesserta',
        ],
    ]);*/ ?>

</div>
