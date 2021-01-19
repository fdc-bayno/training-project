<div class="container">
    <div class="user-wrapper">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create(); ?>
        <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
        <?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
        <?php echo $this->Form->end(array('label' => 'LOGIN', 'class' => 'btn-block')); ?>
    </div>
</div>