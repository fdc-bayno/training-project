<?php

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'logout');
        date_default_timezone_set('Asia/Manila');
    }
    public function login() {
        if ($this->Auth->login()) {
            $this->redirect(
                array('controller' => 'messages', 'action' => 'messageList')
            );
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id');
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
                $this->redirect(
                    array('controller' => 'messages', 'action' => 'messageList')
                );
            } else {
                $this->Session->setFlash(__('Incorrect Email or Password.'));
            }
        }
    }
    public function register() {
        if ($this->request->is('post')) {
            $this->request->data['User']['created_ip'] = $this->request->ClientIp();
            if ($this->User->save($this->request->data)) {
                if ($this->Auth->login()) {
                    $this->User->id = $this->Auth->user('id');
                    $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

                    $this->Session->setFlash(__('Thank you for registering.'));
                    $this->redirect(array('action' => 'thankYou'));
                }
            } else {
                $this->Session->setFlash(__('User not login.'));
            }
        }
    }
    public function thankYou() {

    }
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function profile() {
        
    }
    public function editProfile() {
        if ($this->request->is('post')) {
            $data = array();
            $ip = $this->request->clientIp();
            $file = $this->request->data['User']['photo'];

            if (!empty($this->request->data['User']['name'])) {
                $name = $this->request->data['User']['name'];
                $data['name'] = "'$name'";
            }
            if (!empty($this->request->data['User']['birthdate'])) {
                $birthdate = $this->request->data['User']['birthdate'];
                $data['birthdate'] = "'$birthdate'";
            }
            if (!empty($this->request->data['User']['gender'])) {
                $gender = $this->request->data['User']['gender'];
                $data['gender'] = "'$gender'";
            }
            if (!empty($this->request->data['User']['hubby'])) {
                $hubby = $this->request->data['User']['hubby'];
                $data['hubby'] = "'$hubby'";
            }
            $data['modified_ip'] = "'$ip'";

            if (empty($this->request->data['User']['photo']['tmp_name'])) {
                unset($this->User->validate['photo']);
            }

            if ($this->User->validates()) {
                if (!empty($file) && is_uploaded_file($file['tmp_name'])) {
                    
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $filename = time().'.'.$ext;
                    move_uploaded_file(
                        $file['tmp_name'],
                        WWW_ROOT . DS . 'img/uploads/profiles/' . $filename
                    );
                    $data['image'] = "'$filename'";
                }
            }

            $this->User->updateAll(
                $data,
                array('id' => $this->Auth->user('id'))
            );

            $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));
            $this->redirect(array('action' => 'profile'));
        }
    }
    public function allUsers() {
        $key = $this->request->query['key'];
        $users = $this->User->find('all', array(
            'conditions' => array(
                'User.name LIKE' => '%'.$key.'%'
            )
        ));

        $data = array();
        foreach ($users as $index => $user) {
            $data[$index]['id'] = (int) $user['User']['id'];
            $data[$index]['text'] = $user['User']['name'];
            $data[$index]['image'] = ($user['User']['image']) ? $user['User']['image'] : "default.png";
        }
        
        echo json_encode($data);
        exit;
    }
}