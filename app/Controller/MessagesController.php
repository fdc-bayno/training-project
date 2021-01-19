<?php

class MessagesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('Flash');

    // public function index() {
    //     $this->loadModel('Post');
    //     $this->set('posts', $this->Post->find('all'));
    // }
    public function view($id = null) {
        if (!$id)
            throw new NotFoundException(__('Invalid Post!'));

        $this->loadModel('Post');
        $post = $this->Post->findById($id);
        
        if (!$post) 
            throw new NotFoundException(__('Invalid Post!'));
        
        $this->set('post', $post);
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->loadModel('Post');
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
    public function edit($id = null) {
        if (!$id)
            throw new NotFoundException(__('Invalid Post!'));

        $this->loadModel('Post');
        $post = $this->Post->findById($id);
        if (!$post) 
            throw new NotFoundException(__('Invalid Post!'));

        if ($this->request->is(['post', 'put'])) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data)
            $this->request->data = $post;
    }
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $this->loadModel('Post');

        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
    // 
    public function index() {
        
    }
    public function messageList() {
        
    }
}