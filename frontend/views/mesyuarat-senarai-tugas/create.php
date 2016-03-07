<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiTugas */

$this->title = 'Mesyuarat - Senarai Tugas';
$this->params['breadcrumbs'][] = ['label' => 'Mesyuarat - Senarai Tugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-tugas-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
