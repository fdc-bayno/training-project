<div class="container">

    <div class="message-wrapper">
        <h1 style="margin-bottom:25px">Message List</h1>
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
                $abosultePath = $this->webroot . '/img/uploads/profiles/';
                $photo = ($message['Sender']['image']) ? $abosultePath.$message['Sender']['image'] : $abosultePath.'default.png';
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
                                $authId = (AuthComponent::user('id') == $message['Message']['from_id']) ? $message['Message']['to_id'] : $message['Message']['from_id'];
                                echo $this->Html->link('View Conversation',
                                    array('action' => 'messageDetails', $authId),
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

        <?php if ($this->Paginator->params()['count'] > 0) : ?>
            <div class="text-center" data-count="0" data-total="<?php echo $this->Paginator->params()['count']; ?>">
                <div class="loadmore-btn"></div>
                <?php 
                    echo $this->Form->button(
                        'Load More',
                        array('type' => 'button', 'class' => 'btn btn-primary btn-loadmore')
                    );
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(function() {
        $('.btn-loadmore').on('click', function() {
            var count = $(this).parent().attr('data-count');
            var total = $(this).parent().data('total');
            var limit = 2;
            count = parseInt(count) + parseInt(limit);
    
            $(this).parent().attr('data-count', count);
            var url = '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'loadMore')); ?>/';
            url = url + count;

            // $('.loadmore-btn').show();
            $('.btn-loadmore').hide();
            
            $.ajax({
                url: url,
                beforeSend: function () {
                    $('.loadmore-btn').html('<div class="loading"><div></div><div></div><div></div></div>');
                },
                success: function (response) {
                    setTimeout(function() {
                        $('.message-item:last').after(response).show().fadeIn('slow');
                        $('.loadmore-btn').find('.loading').remove();
                        $('.btn-loadmore').show().text('Load More');
                        var row = count + limit;
                        
                        if (row >= total) {
                            $('.btn-loadmore').parent().html('<hr><i>--- nothing follows ---</i>');
                            $('.btn-loadmore').remove();
                        }
                    }, 1500);
                }
            });
        });
    });
</script>