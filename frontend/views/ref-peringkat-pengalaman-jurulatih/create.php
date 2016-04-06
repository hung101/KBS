<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatPengalamanJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_pengalaman_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_pengalaman_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-pengalaman-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
