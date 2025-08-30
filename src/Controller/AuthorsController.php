<?php
declare(strict_types=1);

// In src/Controller/AuthorsController.php
namespace App\Controller;

use App\Controller\AppController;

class AuthorsController extends AppController
{
    public function index()
    {
        $authors = $this->Authors->find('all');
        $this->set(compact('authors'));
    }

    public function view($id = null)
    {
        $author = $this->Authors->get($id);
        $this->set(compact('author'));
    }

    public function add()
    {
        $author = $this->Authors->newEmptyEntity();
        if ($this->request->is('post')) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the author.'));
        }
        $this->set('author', $author);
    }

    public function edit($id = null)
    {
        $author = $this->Authors->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the author.'));
        }
        $this->set(compact('author'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $author = $this->Authors->get($id);
        if ($this->Authors->delete($author)) {
            $this->Flash->success(__('The author has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the author.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}