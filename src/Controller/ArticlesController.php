<?php
// src/Controller/ArticlesController.php



namespace App\Controller;

class ArticlesController extends AppController
{	
	   public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        //$this->Authentication->allowUnauthenticated(['test']);
        $this->Authentication->addUnauthenticatedActions(['index', 'view','test']);
    }
	public function initialize(): void
	{	
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Include the FlashComponent
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Math');
	}	

	public function test()
	{
		$this->Authorization->skipAuthorization();
		//$article = $this->Articles;
		//$this->set('test',$article);
		echo $this->Math->doComplexOperation(1,2);
	}


	public function index()
	{
		$this->Authorization->skipAuthorization();

		//$article = $this->Articles->find('all');


		$test = $this->Articles->newEmptyEntity()->_getTagString();

		$this->set('test',$test);
		//$articles = $this->Paginator->paginate($this->Articles->find()) = ['limit' => '50'];
		$currentUserArticle = array('conditions' => array('user_id' => 4));
		$articles = $this->Articles->find('all',$currentUserArticle);

		//send data to view
		$this->set('articles',$articles);
		$this->viewBuilder()->setOption('serialize', ['articles']);
		//pr($this->add());

		
	}

	public function view($slug = null)
	{
	$this->Authorization->skipAuthorization();
	$article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
	$test = $this->Articles;

	$this-> set('test',$test);
	$this->set(compact('article'));
	//pr($article);
	//
	}

	public function add()
	{

	
	$article = $this->Articles->newEmptyEntity();
	$this->Authorization->authorize($article);
	//$tag = $this->Tags->newEmptyEntity();
	//$_SESSION['message'] =  $article;
	//session_destroy();
	if ($this->request->is('post')) 
		{
		$article = $this->Articles->patchEntity($article,$this->request->getData());
		
		// Hardcoding the user_id is temporary, and will be removed later
		// when we build authentication out.
		//return $this->request->getData();
		//$article->user_id = 1;
		//$this->Articles->save($article);
		$article->user_id = $this->request->getAttribute('identity')->getIdentifier();
		
		if ($this->Articles->save($article)) 
			{	
			$this->Flash->success(__('success'));
			return $this->redirect(['action' => 'index']);
			} else {
			$this->Flash->error(__('Unable to add your article.'));
			}
	

			
		}
		// Get a list of tags.
		$tags = $this->Articles->Tags->find('list');
		// Set tags to the view context
		
		
		$this->set('data',$this->request->getData());
		$this->set('tags', $tags);
		$this->set('article', $article);
		
		//return $testNow = $this->request->getData();
		
		
	}

	public function edit($slug)
	{
	
	$article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
	$this->Authorization->authorize($article);
	//pr($article['tags']);
	foreach ($article['tags'] as $content){
		echo $content;
	};
	//$currentArticle = $this->Articles->findBySlug($slug)->all();
	//find all tags of current article
	//$currentArticle = $this->Articles->findBySlug($slug)->contain(['Tags'])->all();
	if ($this->request->is(['post', 'put'])) 
		{
		$this->Articles->patchEntity($article, $this->request->getData(),['accessibleFields' => ['user_id' => false]]);
	if ($this->Articles->save($article)) 
		{
		$this->Flash->success(__('Your article has been updated.'));
		return $this->redirect(['action' => 'index']);
		}
		$this->Flash->error(__('Unable to update your article.'));
		}
	// Get a list of tags.
	
	//pr($currentArticle);
	
	/*
	f
	*/
	
	//pr($currentArticle);
	$tags = $this->Articles->Tags->find('list')->all();
	// Set tags to the view context
	

	//pr($articletest);

	$this->set('tags', $tags);
	$this->set('article', $article);
	}

	public function delete($slug)
	{
		$this->Authorization->authorize($article);
		$this->request->allowMethod(['post', 'delete']);
		$article = $this->Articles->findBySlug($slug)->firstOrFail();
		

		if ($this->Articles->delete($article)) 
		{
			$this->Flash->success(__('The {0} article has been deleted.', $article->→title));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function tags($tags)
	{
		// The 'pass' key is provided by CakePHP and contains all
		// the passed URL path segments in the request.
		$this->Authorization->skipAuthorization();
		$tags = $this->request->getParam('pass');
		// Use the ArticlesTable to find tagged articles.
		$articles = $this->Articles->find('Tagged', ['tags' => $tags])->all();
		// Pass variables into the view template context.
		$this->set([
		'articles' => $articles,
		'tags' => $tags
		]);
	}




}