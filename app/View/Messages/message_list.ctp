<div class="container">
    <h1>Message List</h1>

    <div class="message-wrapper">
        <?php 
            echo $this->Html->link(
                'New Message',
                array('action' => 'newMessage'),
                array('class' => 'btn btn-primary')
            );
        ?>
        <hr>
        <?php //foreach ($messages as $message) : ?>
            <h3><?php //echo $message['Message']['content']; ?></h3>
        <?php //endforeach; ?>
        <?php print_r($messages) ?>

    </div>
</div>