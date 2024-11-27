<?php
require("./photos.php");
require("./data.php");

$correct = getCorrectItems();
$inCorrect = getIncorrectItems();

// print "<pre>";
// print_r($correct);
// print "</pre>";

// print "<pre>";
// print_r($_REQUEST);
// print "</pre>";

// print $photos[$correct[1]["photo_id"]];



if (@$_GET['page'] >= count($correct)) {
    header("location: index.php");
};


$currentPage = (int) @$_GET['page'];

$answer = null;

$answer = @$_POST['word'];
// print $answer;




$inCorrectArray = [];
while (count($inCorrectArray) < 3) {
    $inCorrectWord =  $inCorrect[rand(0, 13)]["name"];
    if (!in_array($inCorrectWord, $inCorrectArray)) {
        $inCorrectArray[] =  $inCorrectWord;
    }
}


// print "<pre>";
// print_r($inCorrectArray);
// print "</pre>";




?>



<!DOCTYPE html>
<html lang="en" data-lt-installed="true">

<head>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="My description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <main>
        <section>

            <form action="./main.php?page=<?= $currentPage ?>" method="post" style=<?php $answer == 0 && $answer != null ? print "background-color:#c78787;" : ""; ?>>
                <?php if ($answer == 1 && $answer != null): ?>
                    <h1 style="color: green;"> RIGHT!! the correct answer is <?= $correct[$currentPage]["name"]; ?> </h1>
                <?php elseif ($answer == 0 && $answer != null): ?>
                    <h1 style="color:red;"> Try Again!! </h1>
                <?php elseif (!isset($_REQUEST['word']) && isset($_REQUEST['submit'])): ?>
                    <h1 style="color:red;"> please pick one word </h1>
                <?php endif; ?>
                <fieldset>
                    <legend>Select a right WORD:</legend>
                    <img src="<?php print $photos[$correct[$currentPage]["photo_id"]]; ?>" style="width:450px; margin-left: auto; margin-right: auto;" />
                    <?php if ($answer == 0): ?>
                        <div style=" display: flex; flex-direction: row; gap:20px;">
                            <div style="order: <?= rand(1, 4); ?>">
                                <button type="radio" id="word" name="word" value="1"> <?= $correct[$currentPage]["name"]; ?></button>
                            </div>

                            <div style="order: <?= rand(1, 4); ?>">
                                <button type="radio" id="word" name="word" value="0"><?= $inCorrectArray[0]; ?> </button>
                            </div>
                            <div style="order: <?= rand(1, 4); ?>">
                                <button type="radio" id="word" name="word" value="0"><?= $inCorrectArray[1]; ?> </button>
                            </div>
                            <div style="order: <?= rand(1, 4); ?>">
                                <button type="radio" id="word" name="word" value="0"><?= $inCorrectArray[2]; ?> </button>

                            </div>
                        </div>




                        </div>

                </fieldset>

                <!-- <input type="submit" name="submit" id="submit" /> -->
            <?php else: ?>

                <?php if ($currentPage < count($correct) - 1 && $answer == 1): ?>
                    <a href="./main.php?page=<?php echo $currentPage + 1 ?>"><i>Next </i></a>
                <?php endif ?>
            </form>
        <?php endif; ?>


        </section>


    </main>

</body>

</html>