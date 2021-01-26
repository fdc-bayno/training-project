<div class="container">

    <div class="message-wrapper">
        <h1>Message Detail</h1>
        <hr>
        <?php echo $this->Form->create('Message'); ?>
        <?php 
            echo $this->Form->input(
                'content', array(
                    'type' => 'textarea', 
                    'label' => false, 
                    'class' => 'form-control', 
                    'placeholder' => 'Write your reply'
                )
            );
        ?>
        <?php echo $this->Form->hidden('to_id', array('value' => $user['User']['id'])); ?>
        <div class="text-right">
            <?php 
                echo $this->Form->end(array('label' => 'SEND', 'id' => 'btn-reply'));
            ?>
        </div>

        <div class="message-details-container">
            <?php foreach ($messages as $message) : ?>
                <?php 
                    $abosultePath = $this->webroot . '/img/uploads/profiles/';
                    $photo = ($message['Sender']['image']) ? $abosultePath.$message['Sender']['image'] : $abosultePath.'default.png';
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
                                <?php if (AuthComponent::user('id') == $message['Message']['from_id']) : ?>
                                    <span data-id="<?php echo $message['Message']['id']; ?>" data-toid="<?php echo $user['User']['id']; ?>" class="text-danger delete-message cursor">Delete</span>
                                <?php endif; ?>
                            </div>
                            <div class="date">
                                <?php echo date('Y/m/d H:i A', strtotime($message['Message']['created'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ($this->Paginator->params()['count'] > 10) : ?>
            <div class="text-center" data-count="10" data-total="<?php echo $this->Paginator->params()['count']; ?>">
                <div class="loadmore-btn"></div>
                <?php 
                    echo $this->Form->button(
                        'Load More',
                        array('type' => 'button', 'class' => 'btn btn-primary btn-loadmore')
                    );
                ?>
            </div>
        <?php else : ?>
            <div class="text-center">
                <hr>
                <i>--- nothing follows ---</i>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(function() {
        // # AJAX FORM
        $('#MessageMessageDetailsForm').on('submit', function(e) {
            e.preventDefault();
            var url = "<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'replyMessage')); ?>";
            $('#btn-reply').hide();
            var msg = $(this).find('textarea');

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#btn-reply').parent()
                        .addClass('text-center')
                        .append('<div class="loading"><div></div><div></div><div></div></div>');
                },
                success: function (response) {
                    setTimeout(function() {
                        msg.val('');
                        $('.message-details-container').prepend(response).show().fadeIn();
                        $('#btn-reply').parent().removeClass('text-center');
                        $('#btn-reply').parent().find('.loading').remove();
                        $('#btn-reply').show();
                    }, 1500);

                    setTimeout(function() {
                        $('.message-item').removeClass('new-message');
                    }, 4000);
                },
                error: function() {
                    alert('Error!')
                }
            });
        });

        $('.btn-loadmore').on('click', function() {
            var count = $(this).parent().attr('data-count');
            var total = $(this).parent().data('total');
            var limit = 10;
            count = parseInt(count) + parseInt(limit);
    
            $(this).parent().attr('data-count', count);
            var url = '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'fetchMessages')); ?>/';
            url = url + count + '/<?php echo $user['User']['id']; ?>';

            $('.btn-loadmore').hide();
            
            $.ajax({
                url: url,
                beforeSend: function () {
                    $('.loadmore-btn').html('<div class="loading"><div></div><div></div><div></div></div>');
                },
                success: function (response) {
                    setTimeout(function() {
                        // $('.message-item:last').after(response).show().fadeIn('slow');
                        $('.message-details-container').append(response);
                        $('.loadmore-btn').find('.loading').remove();
                        $('.btn-loadmore').show().text('Load More');
                        var row = count + limit;
                        
                        if (row >= total) {
                            $('.btn-loadmore').parent().html('<hr><i>--- nothing follows ---</i>');
                            $('.btn-loadmore').remove();
                        }
                    }, 1500);

                    setTimeout(function() {
                        $('.message-item').removeClass('new-message');
                    }, 4000);
                }
            });
        });

        $(document).on('click', '.delete-message', function() {
            var data = $(this).data();
            var $this = $(this).parents('.message-item');
            var url = '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'deleteMessage')); ?>';

            if (confirm("Delete this message?")) {
                $.post(url, data, function(response) {
                    $this.addClass('deleted-message').fadeOut();
                });
            }
            return false;
        });
    });
</script>