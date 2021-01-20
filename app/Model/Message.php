<?php

class Message extends AppModel {
    public $validate = array(
        'to_id' => array(
            'rule' => 'notBlank'
        ),
        'content' => array(
            'rule' => array('minLength', 3),
            'message' => 'Minimum of 3 characters.'
        )
    );
}