<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAduanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_aduan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_aduan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-aduan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
