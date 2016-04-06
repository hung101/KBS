<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaSukanPersatuanPersekutuandunia */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::nama_sukan_persatuan_persekutuandunia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::nama_sukan_persatuan_persekutuandunia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-sukan-persatuan-persekutuandunia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
