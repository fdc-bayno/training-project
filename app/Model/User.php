<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'name' => array(
            'rule' => array('lengthBetween', 5, 20),
            'message' => 'Between 5 to 20 characters only'
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'Email is required.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Email is already exist.'
            )
        ),
        'password' => array(
            'rule' => array('minLength', 6),
            'message' => 'Password must be at least 6 characters long.'
        ),
        'confirm_password' => array(
            'compare' => array(
                'rule' => array('compare_password'),
                'message' => 'Password does not match!'
            )
        ),
        'image' => array(
            'rule' => array(
                'extension',
                array('gif', 'jpeg', 'png', 'jpg')
            ),
            'message' => 'Please upload a valid image.'
        )
    );

    public function compare_password() {
        return $this->data[$this->alias]['password'] === $this->data[$this->alias]['confirm_password'];
    }

    public function beforeSave($options = array()) {
        if (!$this->password) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}