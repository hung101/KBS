<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
/* @var $this yii\web\View */
/* @var $model app\models\RefUniversitiInstitusiEBiasiswa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::universiti_institusi_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-universiti-institusi-ebiasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
			[
                'attribute' => 'ref_universiti_institusi_kategori_e_biasiswa_id',
                'value' => $model->refUniversitiInstitusiKategoriEBiasiswa->desc,
            ],
            'desc',
            [
                'attribute' => 'aktif',
                'value' => $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no,
            ],
        ],
    ]) ?>

</div>
