<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliGabungan */

//$this->title = $model->ahli_gabungan_id;
$this->title =  'Ahli Gabungan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_ahli_gabungan, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-ahli-gabungan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-gabungan']['update']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->ahli_gabungan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-gabungan']['delete']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->ahli_gabungan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::print_pdf, [ 'class' => 'btn btn-info', 'onclick' => 'window.print();' ]); ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ahli_gabungan_id',
            'nama_badan_sukan',
            'alamat_badan_sukan',
            'nama_penuh_presiden_badan_sukan',
            'nama_penuh_setiausaha_badan_sukan',
        ],
    ]);*/ ?>

</div>
