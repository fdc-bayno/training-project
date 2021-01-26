<?php foreach ($messages as $message) : ?>
    <?php 
        $abosultePath = $this->webroot . '/img/uploads/profiles/';
        $photo = ($message['Sender']['image']) ? $abosultePath.$message['Sender']['image'] : $abosultePath.'default.png';
    ?>
    <div class="card message-item new-message <?php echo (AuthComponent::user('id') == $message['Message']['from_id']) ? "right" : "left"; ?> clearfix">
        <div class="user-photo background-image" style="background-image: url(<?php echo $photo; ?>)"></div>
        <div class="user-body">
            <div class="content mr-20">
                <?php echo $message['Message']['content'] ?>
            </div>
            <div class="clearfix"></div>
            <div class="footer">
                <div class="msg-actions">
                    <?php if (AuthComponent::user('id') == $message['Message']['from_id']) : ?>
                        <span data-id="<?php echo $message['Message']['id']; ?>" class="delete-message cursor">Delete</span>
                    <?php endif; ?>
                </div>
                <div class="date">
                    <?php echo date('Y/m/d H:i A', strtotime($message['Message']['created'])) ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>