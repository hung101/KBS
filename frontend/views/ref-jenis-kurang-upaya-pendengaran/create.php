<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKurangUpayaPendengaran */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kurang_upaya_pendengaran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kurang_upaya_pendengaran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kurang-upaya-pendengaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
