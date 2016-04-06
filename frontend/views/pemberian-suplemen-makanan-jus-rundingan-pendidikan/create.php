<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PemberianSuplemenMakananJusRundinganPendidikan */

$this->title = GeneralLabel::createTitle . ' Pemberian Suplemen/Jus';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemberian_suplemenjus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-suplemen-makanan-jus-rundingan-pendidikan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
