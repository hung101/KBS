<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKadarKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kadar_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kadar_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kadar-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
