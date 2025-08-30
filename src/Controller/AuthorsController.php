<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class AuthorsController extends AppController
{
    public function index()
    {
        $authors = $this->Authors->find('all');
        $this->set(compact('authors'));
        $this->viewBuilder()->setOption('serialize', ['authors']);
    }

    public function view($id = null)
    {
        $author = $this->Authors->get($id);
        if (!$author) {
            throw new NotFoundException(__('Author not found'));
        }
        $this->set(compact('author'));
        $this->viewBuilder()->setOption('serialize', ['author']);
    }

    public function add()
    {
        $author = $this->Authors->newEmptyEntity();
        if ($this->request->is('post')) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->set(compact('author'));
                $this->viewBuilder()->setOption('serialize', ['author']);
                $this->response = $this->response->withStatus(201); // HTTP Created
            } else {
                $this->response = $this->response->withStatus(400); // Bad Request
            }
        }
    }

    public function edit($id = null)
    {
        $author = $this->Authors->get($id);
        if (!$author) {
            throw new NotFoundException(__('Author not found'));
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->set(compact('author'));
                $this->viewBuilder()->setOption('serialize', ['author']);
            } else {
                $this->response = $this->response->withStatus(400); // Bad Request
            }
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $author = $this->Authors->get($id);
        if (!$author) {
            throw new NotFoundException(__('Author not found'));
        }
        if ($this->Authors->delete($author)) {
            $this->response = $this->response->withStatus(204); // No Content
        } else {
            $this->response = $this->response->withStatus(400); // Bad Request
        }
    }
}