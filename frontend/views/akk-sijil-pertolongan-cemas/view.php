<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilPertolonganCemas */

$this->title = $model->akk_sijil_pertolongan_cemas_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_sijil_pertolongan_cemas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-sijil-pertolongan-cemas-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->akk_sijil_pertolongan_cemas_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->akk_sijil_pertolongan_cemas_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php

use app\models\general\GeneralLabel;
 /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'akk_sijil_pertolongan_cemas_id',
            'akademi_akk_id',
            'no_sijil',
            'tahap',
            'tahun',
            'sijil',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
