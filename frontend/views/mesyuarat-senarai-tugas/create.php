<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiTugas */

$this->title = GeneralLabel::mesyuarat_senarai_tugas;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_senarai_tugas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-tugas-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
