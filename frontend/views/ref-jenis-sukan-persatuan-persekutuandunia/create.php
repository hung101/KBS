<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisSukanPersatuanPersekutuandunia */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_sukan_persatuan_persekutuandunia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_sukan_persatuan_persekutuandunia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-sukan-persatuan-persekutuandunia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
