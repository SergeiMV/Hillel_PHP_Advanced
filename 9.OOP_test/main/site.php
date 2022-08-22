<?php

require_once("/vendor/autoload.php");

$testCount1 = 5;
$testCount2 = 3;
$mergeCount1 = 3;
$mergeCount2 = 6;

$factory = new Autobots\Foundation\Factory();

$factory->addType(new Autobots\Transformers\Transformer1());
$factory->addType(new Autobots\Transformers\Transformer2());

$mergeTransformer = new Autobots\Transformers\MergeTransformer();

$factory->addType($mergeTransformer);

$merge2 = current($factory->createMergeTransformer(1));

$army1 = $factory->createTransformer1($testCount1);
$army2 = $factory->createTransformer2($testCount2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  <link rel="stylesheet" href="/public/styles/css/site.css">
  <title>Factory</title>
</head>
<body>
    <h1 class="bg-dark text-light"> FACTORY </font></h1>
    <?php flush(); ?>
    <?php sleep(2); ?>
    <table class="table table-bordered align-middle bg-dark bg-opacity-75 text-light">
        <body>
            <tr><td colspan="3" class="bg-warning bg-opacity-25"></td></tr>
            <?php foreach ($factory->getTypes() as $key => $type) : ?>
                <?php if (is_object($type)) : ?>
                    <tr>
                        <td colspan="3" class="align-middle">Type: <?= $key ?></td>
                    </tr>
                    <tr>
                        <td>Speed: <?= $type->getSpeed() ?></td>
                        <td>Weight: <?= $type->getWeight() ?></td>
                        <td>Height: <?= $type->getHeight() ?></td>
                    </tr>
                    <tr><td colspan="3" class="bg-warning bg-opacity-25"></td></tr>
                <?php endif;?>
            <?php endforeach; ?>
        </body>
    </table>
    <br>
    <?php flush(); ?>
    <?php sleep(2); ?>
    <h1 class="bg-dark text-light"> TESTING MERGE TRANSFORMER </font></h1>
    <?php flush(); ?>
    <?php sleep(2); ?>
    <table class="table table-bordered align-middle bg-dark bg-opacity-75 text-light">
        <body>
            <tr>
                <td colspan="2" class="bg-warning bg-opacity-25">
                    Merging Merge Transformer with <?= $mergeCount1 ?> Transformer1
                </td>
            </tr>
            <tr>
                <td><?= current($factory->createMergeTransformer(1)) ?></td>
                <td><?= current($factory->createTransformer1(1)) ?></td>
            </tr>
            <tr>
                <td colspan="2"> RESULT </td>
            </tr>
            <tr>
                <?php $mergeTransformer->addTransformer($factory->createTransformer1($mergeCount1)) ?>
                <td colspan="2"><?= $mergeTransformer ?></td>
            </tr>
        </body>
    </table>

    <table class="table table-bordered align-middle bg-dark bg-opacity-75 text-light">
        <body>
            <tr>
                <td colspan="2" class="bg-warning bg-opacity-25">
                    Merging Merge Transformer with <?= $mergeCount2 ?> Transformer2
                </td>
            </tr>
            <tr>  
                <td><?= current($factory->createMergeTransformer(1)) ?></td>
                <td><?= current($factory->createTransformer2(1)) ?></td>
            </tr>
            <tr>
                <td colspan="2"> RESULT </td>
            </tr>
            <tr>
                <?php $mergeTransformer->addTransformer($factory->createTransformer2($mergeCount2)) ?>
                <td colspan="2"><?= $mergeTransformer ?></td>
            </tr>
        </body>
    </table>
    <h1 class="bg-dark text-light"> PRODUCED TRANSFORMERS </font></h1>
    <?php flush(); ?>
    <?php sleep(2); ?>
    <table class="table table-bordered align-middle bg-dark bg-opacity-75 text-light">
        <body>
            <tr>
                <td colspan="<?= $testCount1 ?>" class="bg-warning bg-opacity-25"></td>
            </tr>
            <tr>
                <td colspan="<?= $testCount1 ?>" class="align-middle">
                    <h2> <?= $testCount1 ?> units of Transformer1 </h2>
                </td>
            </tr>
            <tr>  
                <?php foreach ($army1 as $type) : ?>
                    <td> <?= $type ?></td>
                <?php endforeach; ?>
           </tr>
           <tr>
                <td colspan="<?= $testCount1 ?>" class="bg-warning bg-opacity-25"></td>
            </tr>
        </body>
    </table>
    <table class="table table-bordered align-middle bg-dark bg-opacity-75 text-light">
        <body>
            <tr>
                <td colspan="<?= $testCount2 ?>" class="bg-warning bg-opacity-25"></td>
            </tr>
            <tr>
                <td colspan="<?= $testCount2 ?>" class="align-middle">
                    <h2> <?= $testCount2 ?> units of Transformer2 </h2>
                </td>
            </tr>
            <tr>  
                <?php foreach ($army2 as $type) : ?>
                    <td> <?= $type ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td colspan="<?= $testCount2 ?>" class="bg-warning bg-opacity-25"></td>
            </tr>
        </body>
    </table>
</body>
</html>
