<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriBajetJkkJkp */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Bajet Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Bajet Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-bajet-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
