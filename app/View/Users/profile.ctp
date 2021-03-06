<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">User Profile</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <figure>
                        <?php 
                            $image = AuthComponent::user('image') ? 'uploads/profiles/'.AuthComponent::user('image')  : 'uploads/profiles/default.png'.AuthComponent::user('image');
                            echo $this->Html->image(
                                $image,
                                array('class' => 'img-responsive preview-photo cursor')
                            );
                        ?>
                    </figure>
                </div>
                <div class="col-md-9">
                    <div class="profile-wrapper">
                        <h1><?php echo AuthComponent::user('name') ?></h1>
                        <p>
                            <strong>Gender:</strong>
                            <?php
                                if (AuthComponent::user('gender') == '1') {
                                    echo 'Male';
                                } elseif (AuthComponent::user('gender') == '2') {
                                    echo 'Female';
                                } else {
                                    echo '<i>Not Specified</i>';
                                }
                            ?>
                        </p>
                        <p><strong>Birthdate:</strong> <?php echo date('F j, Y', strtotime(AuthComponent::user('birthdate'))) ?></p>
                        <p><strong>Joined:</strong> <?php echo date('F j, Y h:i A', strtotime(AuthComponent::user('created'))) ?></p>
                        <p><strong>Last Login:</strong> <?php echo date('F j, Y h:i A', strtotime(AuthComponent::user('last_login_time'))) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Hubby:</h3>
                    <p><?php echo AuthComponent::user('hubby') ?></p>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?php
                echo $this->Html->link(
                    'Edit Profile',
                    array('action' => 'editProfile'),
                    array('class' => 'btn btn-info btn-sm')
                );
            ?>
        </div>
    </div>
</div>