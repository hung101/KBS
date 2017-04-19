<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKadarKemudahanMsn */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kadar_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::acara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kadar-kemudahan-msn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
