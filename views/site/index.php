<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Main';
?>
<div class="container">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" id="calculatorForm" action="<?= Url::to('/site/calculator') ?>">
                    <div class="form-group">
                        <label for="exampleInputName2">Expression</label>
                        <input type="text" name="expression" class="form-control" id="exampleInputName2" placeholder="Expression">
                    </div>
                    <button type="submit" class="btn btn-default">Evaluate</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xs-12" id="resultPanel" style="display: none">
        <div class="panel panel-default">
            <div class="panel-body" id="resultWrapper"></div>
        </div>
    </div>
</div>

