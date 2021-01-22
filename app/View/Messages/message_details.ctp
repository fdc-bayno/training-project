<div class="container">

    <div class="message-wrapper">
        <h1>Message Detail</h1>
        <hr>
        <?php echo $this->Form->create('Message'); ?>
        <?php 
            echo $this->Form->input(
                'content', 
                array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Message')
            );
        ?>
        <?php echo $this->Form->hidden('to_id', array('value' => $this->request->params['pass'][0])); ?>
        <div class="text-right">
            <?php echo $this->Form->end('Send');?>
        </div>
        <hr>
        <?php foreach ($messages as $message) : ?>
            <?php 
                $photo = ($message['Sender']['image']) ? $this->webroot.'/img/uploads/profiles/'.$message['Sender']['image'] : $this->webroot.'/img/uploads/profiles/default.png';
            ?>
            <div class="card message-item <?php echo (AuthComponent::user('id') == $message['Message']['from_id']) ? "right" : "left"; ?> clearfix">
                <div class="user-photo background-image" style="background-image: url(<?php echo $photo; ?>)"></div>
                <div class="user-body">
                    <div class="content mr-20">
                        <?php echo $message['Message']['content'] ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="footer">
                        <div class="msg-actions">
                            <?php
                                if (AuthComponent::user('id') == $message['Message']['from_id']) {
                                    echo $this->Html->link('Delete',
                                        array('action' => 'messageDetails', $message['Message']['id']),
                                        array('class' => 'text-danger')
                                    );
                                }
                            ?>
                        </div>
                        <div class="date">
                            <?php echo date('Y/m/d H:i A', strtotime($message['Message']['created'])) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    $(function() {
        // # AJAX FORM
    });
</script>