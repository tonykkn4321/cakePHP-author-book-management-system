<?php
declare(strict_types=1);

// In src/Controller/BooksController.php
namespace App\Controller;

use App\Controller\AppController;

class BooksController extends AppController
{
    public function index()
    {
        $books = $this->Books->find('all')->contain(['Authors']);
        $this->set(compact('books'));
    }

    public function view($id = null)
    {
        $book = $this->Books->get($id, ['contain' => ['Authors']]);
        $this->set(compact('book'));
    }

    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the book.'));
        }
        $this->set('book', $book);
    }

    public function edit($id = null)
    {
        $book = $this->Books->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the book.'));
        }
        $this->set(compact('book'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the book.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}