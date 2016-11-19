<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPendidikan Atlet::findOne($id)*/

$this->title = GeneralLabel::tambah_pendidikan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_pendidikans, 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
