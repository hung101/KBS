<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratPegawai */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::mesyuarat_pegawai;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-mesyuarat-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
