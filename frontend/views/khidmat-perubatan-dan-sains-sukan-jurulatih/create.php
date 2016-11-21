<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanJurulatih */

$this->title = 'Create Khidmat Perubatan Dan Sains Sukan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
