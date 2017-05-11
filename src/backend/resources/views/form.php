<html>
<body>
    <h2>Survey</h2>

    <form method="POST">
        <?php foreach ($questions as $question) : ?>
            <?php
            $answer = isset($question->users[0]) ? $question->users[0]->pivot->answer : null;
            ?>
            <span><?= $question->title ?></span>
            <input type="radio" name="<?= $question->id ?>" value="true" <?= $answer === 1 ? 'checked' : ''?>> Yes
            <input type="radio" name="<?= $question->id ?>" value="false" <?= $answer === 0 ? 'checked' : ''?>> No
            <br/>
        <?php endforeach; ?>

        <input type="submit" value="Save">
    </form>
</body>
</html>