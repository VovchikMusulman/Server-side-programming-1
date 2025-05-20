<h1>Популярные книги</h1>
<ol>
    <?php
    foreach ($posts as $post) {
        echo '<li>' . $post->title . '</li>';
    }
    ?>
</ol>