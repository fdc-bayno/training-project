<div class="container">
    <div class="user-wrapper">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
        <?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
        <?php 
            echo $this->Form->input(
                'confirm_password',
                array('type' => 'password', 'class' => 'form-control')
            ); 
        ?>
        <?php echo $this->Form->end(array('label' => 'Register', 'class' => 'btn-block')); ?>
    </div>
</div>