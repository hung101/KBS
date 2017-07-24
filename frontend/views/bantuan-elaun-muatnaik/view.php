<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPermohonan */

//$this->title = $model->bantuan_elaun_muatnaik_id;
$this->title = GeneralLabel::viewTitle . ' '.GeneralLabel::lampiran_perbelanjaanresit;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lampiran_perbelanjaanresit, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-muatnaik-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_elaun_muatnaik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_elaun_muatnaik_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_elaun_muatnaik_id',
            'butiran_permohonan',
            'amaun',
            'muatnaik_dokumen',
        ],
    ]);*/ ?>

</div>
