<html>
<body>
    <h2>Survey</h2>

    <form>
        <?php foreach ($questions as $key => $question) : ?>
            <span><?= $question->title ?></span>
            <input type="radio" name="<?= $question->id ?>" value="yes" checked> Yes
            <input type="radio" name="<?= $question->id ?>" value="no"> No
            <br/>
        <?php endforeach; ?>

        <input type="submit" value="Save">
    </form>
</body>
</html>