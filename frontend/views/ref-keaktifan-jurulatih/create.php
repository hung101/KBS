<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKeaktifanJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::keaktifan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keaktifan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-keaktifan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
