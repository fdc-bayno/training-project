<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Edit User Profile</h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Form->create('User', array('type' => 'file')); ?>
            <div class="row">
                <div class="col-md-3">
                    <figure class="photo">
                        <label for="photo">
                            <?php 
                                $image = AuthComponent::user('image') ? 'uploads/profiles/'.AuthComponent::user('image')  : 'uploads/profiles/default.png'.AuthComponent::user('image');
                                echo $this->Html->image(
                                    $image,
                                    array('class' => 'img-responsive preview-photo cursor')
                                );
                            ?>
                        </label>
                    </figure>
                    <?php echo $this->Form->file('photo', array('id' => 'photo', 'label' => 'false')); ?>
                </div>
                <div class="col-md-9">
                    <div class="profile-wrapper">
                        <?php 
                            echo $this->Form->input(
                                'name',
                                array('class' => 'form-control', 'value' => AuthComponent::user('name'))
                            ); 
                        ?>
                        <?php 
                            echo $this->Form->input(
                                'birthdate',
                                array('id' => 'datepicker', 'type' => 'text', 'class' => 'form-control', 'value' => AuthComponent::user('birthdate'))
                            ); 
                        ?>
                        <?php 
                            echo $this->Form->input('gender',
                                array(
                                    'separator' => '<div></div>',
                                    'type' => 'radio', 
                                    'options' => array(1 => 'Male', 2 => 'Female'),
                                    'value' => AuthComponent::user('gender')
                                )
                            ); 
                        ?>
                        <?php 
                            echo $this->Form->input(
                                'hubby',
                                array('class' => 'form-control', 'value' => AuthComponent::user('hubby'))
                            ); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?php echo $this->Form->end(array('label' => 'Update', 'class' => 'btn btn-info')); ?>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#datepicker').datepicker({
        dateFormat: "yy-mm-dd"
    });

    $('#photo').on('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.preview-photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>