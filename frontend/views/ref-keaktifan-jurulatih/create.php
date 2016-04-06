<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKeaktifanJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Keaktifan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Keaktifan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-keaktifan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
