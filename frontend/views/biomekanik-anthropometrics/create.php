<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikAnthropometrics */

$this->title = GeneralLabel::tambah_biomekanik_anthropometrics;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::biomekanik_anthropometrics, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-anthropometrics-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
