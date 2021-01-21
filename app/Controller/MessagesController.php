<?php

class MessagesController extends AppController {
    public $components = array('Paginator', 'Flash');

    private function rr($data) {
        echo '<pre>';
        print_r($data);
        exit;
    }
    public function messageList() {
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
            'limit' => 2,
        ));

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
    public function loadmoreMessage() {
        if ($this->request->is('ajax')) {

            exit;
        }
    }
    public function messageDetails($id = null) {
        // #
    }
}