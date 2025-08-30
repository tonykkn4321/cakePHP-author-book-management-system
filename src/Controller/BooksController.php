<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class BooksController extends AppController
{
    public function index()
    {
        $books = $this->Books->find('all')->contain(['Authors']);
        $this->set(compact('books'));
        $this->viewBuilder()->setOption('serialize', ['books']);
    }

    public function view($id = null)
    {
        $book = $this->Books->get($id, ['contain' => ['Authors']]);
        if (!$book) {
            throw new NotFoundException(__('Book not found'));
        }
        $this->set(compact('book'));
        $this->viewBuilder()->setOption('serialize', ['book']);
    }

    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->set(compact('book'));
                $this->viewBuilder()->setOption('serialize', ['book']);
                $this->response = $this->response->withStatus(201); // HTTP Created
            } else {
                $this->response = $this->response->withStatus(400); // Bad Request
            }
        }
    }

    public function edit($id = null)
    {
        $book = $this->Books->get($id);
        if (!$book) {
            throw new NotFoundException(__('Book not found'));
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->set(compact('book'));
                $this->viewBuilder()->setOption('serialize', ['book']);
            } else {
                $this->response = $this->response->withStatus(400); // Bad Request
            }
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if (!$book) {
            throw new NotFoundException(__('Book not found'));
        }
        if ($this->Books->delete($book)) {
            $this->response = $this->response->withStatus(204); // No Content
        } else {
            $this->response = $this->response->withStatus(400); // Bad Request
        }
    }
}