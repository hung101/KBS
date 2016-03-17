<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikAnthropometrics */

$this->title = $model->biomekanik_anthropometrics_id;
$this->params['breadcrumbs'][] = ['label' => 'Biomekanik Anthropometrics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-anthropometrics-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->biomekanik_anthropometrics_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->biomekanik_anthropometrics_id], [
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

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'biomekanik_anthropometrics_id',
            'perkhidmatan_biomekanik_id',
            'anthropometrics',
            'cm_kg',
        ],
    ]);*/ ?>

</div>
