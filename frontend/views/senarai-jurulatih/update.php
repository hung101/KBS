<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiJurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::senarai_jurulatih.': ' . ' ' . $model->senarai_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_jurulatih_id, 'url' => ['view', 'id' => $model->senarai_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="senarai-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
