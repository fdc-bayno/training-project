<div class="container">
    <div class="jumbotron text-center">
        <h2>Thank you for registering.</h2>
        <br>
        <?php 
            echo $this->Html->link(
                'Back to homepage', 
                array('controller' => 'messages', 'action' => 'messageList'),
                array('class' => 'btn btn-info btn-lg')
            ); 
        ?>
    </div>
</div>