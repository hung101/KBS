<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanGeranBantuanGajiJurulatih */

$this->title = 'Create Ref Kelulusan Geran Bantuan Gaji Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Geran Bantuan Gaji Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-geran-bantuan-gaji-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
