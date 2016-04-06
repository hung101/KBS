<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih.': ' . ' ' . $model->jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jurulatih_id, 'url' => ['view', 'id' => $model->jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
