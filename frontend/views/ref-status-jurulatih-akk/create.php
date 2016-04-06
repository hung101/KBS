<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJurulatihAkk */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Jurulatih Akk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Jurulatih Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-jurulatih-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
