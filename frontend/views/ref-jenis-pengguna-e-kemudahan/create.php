<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPenggunaEKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_pengguna;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_pengguna, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-pengguna-ekemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
