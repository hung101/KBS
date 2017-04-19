<?php

use app\models\general\GeneralLabel;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pencalonan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pencalonan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
