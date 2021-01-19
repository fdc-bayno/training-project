<h1>Latest Posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <?php foreach ($posts as $post) : ?>
        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td><?php echo $post['Post']['title']; ?></td>
            <td><?php echo $post['Post']['created']; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>