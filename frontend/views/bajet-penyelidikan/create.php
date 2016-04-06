<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */

$this->title = GeneralLabel::tambah_bajet_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bajet_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bajet-penyelidikan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
