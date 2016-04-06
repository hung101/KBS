<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapPendidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_peringkatan_pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
