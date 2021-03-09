<?php
// src/Controller/ArticlesController.php



namespace App\Controller;
session_start();
class ArticlesController extends AppController
{
	public function initialize(): void
	{	
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Include the FlashComponent
	}	


	public function index()
	{
		
		$articles = $this->Paginator->paginate($this->Articles->find());

		//send data to view
		$this->set(compact('articles'));


		
	}

	public function view($slug = null)
	{
	$article = $this->Articles->findBySlug($slug)->firstOrFail();
	$this->set(compact('article'));
	}

	public function add()
	{

	
	$article = $this->Articles->newEmptyEntity();
	$_SESSION['message'] =  $article;
	//session_destroy();
	if ($this->request->is('post')) 
		{
		$article = $this->Articles->patchEntity($article, $this->request->getData());
		
		// Hardcoding the user_id is temporary, and will be removed later
		// when we build authentication out.
		//return $this->request->getData();
		$article->user_id = 1;
		//$this->Articles->save($article);
		
		if ($this->Articles->save($article)) {	
			$this->Flash->success(__('success'));
			return $this->redirect(['action' => 'index']);
			} else {
			$this->Flash->error(__('Unable to add your article.'));
			}

		}
		$this->set('article', $article);
		pr($article);
	}

	public function edit($slug)
	{
	$article = $this->Articles->findBySlug($slug)->firstOrFail();
	if ($this->request->is(['post', 'put'])) 
		{
		$this->Articles->patchEntity($article, $this->request->getData());
	if ($this->Articles->save($article)) 
		{
		$this->Flash->success(__('Your article has been updated.'));
		return $this->redirect(['action' => 'index']);
		}
		$this->Flash->error(__('Unable to update your article.'));
		}
	$this->set('article', $article);
	}

	public function delete($slug)
	{
		$this->request->allowMethod(['post', 'delete']);
		$article = $this->Articles->findBySlug($slug)->firstOrFail();
		if ($this->Articles->delete($article)) 
		{
			$this->Flash->success(__('The {0} article has been deleted.', $article->→title));
			return $this->redirect(['action' => 'index']);
		}
	}

}