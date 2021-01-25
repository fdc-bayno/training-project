<?php

class MessagesController extends AppController {
    public $components = array('Paginator', 'Flash');
    public $limit = 10;

    private function rr($data) {
        echo '<pre>';
        print_r($data);
        exit;
    }
    public function messageList() {
        $this->loadMore();
        $messages = $this->paginate('Message');
        $this->set(compact('messages'));
    }
    public function newMessage() {
        if ($this->request->is('post')) {
            $this->request->data['Message']['from_id'] = $this->Auth->user('id');
            if ($this->Message->save($this->request->data)) {
                $this->redirect(array('action' => 'messageList'));
            }
        }
    }
    public function loadMore($count = 0) {
        $authId = $this->Auth->user('id');
        $this->paginate = array('Message' => array(
            'fields' => array(
                'Message.*',
                'Sender.id',
                'Sender.name',
                'Sender.image',
                'Receiver.id',
                'Receiver.name',
                'Receiver.image',
            ),
            'conditions' => array(
                "Message.id IN
                (SELECT max(id)
                    FROM messages
                    WHERE (messages.from_id = {$authId} OR messages.to_id = {$authId}) AND messages.status = 'active'
                    GROUP BY 
                        IF (from_id = {$authId}, to_id, from_id),
                        IF (from_id != {$authId}, to_id, from_id))"
            ),
            'joins' => array(
                array(
                    'alias' => 'Sender',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => array('Message.from_id = Sender.id')
                ),
                array(
                    'alias' => 'Receiver',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => array('Message.to_id = Receiver.id')
                )
            ),
            'order' => 'created DESC',
            'limit' => $this->limit,
            'offset' => $count,
        ));
        if ($this->request->is('ajax')) {
            $messages = $this->paginate('Message');
           
            $this->layout = false;
            $this->set(compact('messages'));
        }
    }
    public function messageDetails($id = null) {
        $authId = $this->Auth->user('id');

        // load User Model
        $this->loadModel('User');
        $this->User->id = $id;
        $user = $this->User->read('id');

        // paginate messages
        $this->fetchMessages(0, $id);

        $messages = $this->paginate('Message');
        $this->set(compact('user', 'messages'));
    }
    public function replyMessage() {
        $authId = $this->Auth->user('id');
        if ($this->request->is('post')) {
            $toId = $this->request->data['Message']['to_id'];
            $this->request->data['Message']['from_id'] = $authId;
            
            if ($this->Message->save($this->request->data)) {

                $this->layout = false;
                $this->fetchMessages(1, $toId);

                $messages = $this->paginate('Message');
                $this->set(compact('messages'));
            }
        }
    }
    public function fetchMessages($count = 0, $id) {
        $authId = $this->Auth->user('id');
        $limit = $this->limit;
        if ($count == 1) {
            $limit = 1;
            $count = 0;
        }
        $this->paginate = array('Message' => array(
            'fields' => array(
                'Message.*',
                'Sender.id',
                'Sender.image',
                'Receiver.id',
                'Receiver.image'
            ),
            'conditions' => array(
                'OR' => array(
                    array('Message.from_id' => $id, 'Message.to_id' => $authId),
                    array('Message.from_id' => $authId, 'Message.to_id' => $id),
                ),
                array('status' => 'active')
            ),
            'joins' => array(
                array(
                    'alias' => 'Sender',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => array('Message.from_id = Sender.id')
                ),
                array(
                    'alias' => 'Receiver',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => array('Message.to_id = Receiver.id')
                )
            ),
            'order' => 'created DESC',
            'limit' => $limit,
            'offset' => $count
        ));
        if ($this->request->is('ajax')) {
            $messages = $this->paginate('Message');
           
            $this->layout = false;
            $this->set(compact('messages'));
        }
    }
    public function deleteMessage($id = null) {
        
    }
}