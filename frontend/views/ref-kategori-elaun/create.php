<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\Viewdelete() */
/* @var $model app\models\RefKategoriElaun */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
