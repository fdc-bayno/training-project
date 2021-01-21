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
        <?php foreach ($messages as $message) : ?>
            <?php 
                $photo = ($message['Sender']['image']) ? $this->webroot.'/img/uploads/profiles/'.$message['Sender']['image'] : $this->webroot.'/img/uploads/profiles/default.png';
            ?>
            <div class="card message-item <?php echo (AuthComponent::user('id') == $message['Message']['from_id'] ) ? "right" : "left"; ?> clearfix">
                <div class="header mb-10">
                    <?php if (AuthComponent::user('id') == $message['Message']['from_id']) : ?>
                        <span class="meta-type">
                            <i>To: <?php echo $message['Receiver']['name'] ?></i>
                        </span>
                    <?php else : ?>
                        <span class="meta-type">
                            <i>From: <?php echo $message['Sender']['name'] ?></i>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="user-photo background-image" style="background-image: url(<?php echo $photo; ?>)"></div>
                <div class="user-body">
                    <div class="content mr-20">
                        <?php echo $message['Message']['content'] ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="footer">
                        <div class="msg-actions">
                            <?php 
                                echo $this->Html->link('View Conversation',
                                    array('action' => 'messageDetails', $message['Message']['from_id']),
                                    array('class' => 'mr-10')
                                );
                            ?>
                            <?php 
                                echo $this->Html->link('Delete',
                                    array('action' => 'messageDetails', $message['Message']['id']),
                                    array('class' => 'text-danger')
                                );
                            ?>
                        </div>
                        <div class="date">
                            <?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="text-center">
            <?php 
                echo $this->Form->button(
                    'Load More',
                    array('type' => 'button', 'class' => 'btn btn-primary btn-loadmore')
                );
            ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.btn-loadmore').on('click', function() {
            
        });
    });
</script>