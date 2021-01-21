<div class="container">
    <h1>New Message</h1>

    <div class="new-message-wrapper">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create('Message'); ?>
        <?php 
            echo $this->Form->input(
                'to_id',
                array('class' => 'form-control recipients')
            );
        ?>
        <?php 
            echo $this->Form->input(
                'content',
                array('type' => 'textarea', 'placeholder' => 'Message', 'class' => 'form-control')
            );
        ?>
        <?php echo $this->Form->end('Send'); ?>
    </div>
</div>
<script>
$(function() {
    var url = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'allUsers')); ?>";
    $('.recipients').select2({
        placeholder: 'Search recipient...',
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (data) {
                return {
                    key: data.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            }
        },
        templateResult: UserWithImage,
    });
    
    function UserWithImage(user) {
        console.log(user);
        var root = '<?php echo $this->webroot; ?>';
        if (user.loading) {
            return user.text;
        }

        var $html = $(`
            <div><img width="30" src="${root}/img/uploads/profiles/${user.image}"/> ${user.text}</div>
        `);

        return $html;
    }
});

</script>