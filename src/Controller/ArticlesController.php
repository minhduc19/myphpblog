<?php
// src/Controller/ArticlesController.php



namespace App\Controller;
use Cake\Datasource\ConnectionManager;


class ArticlesController extends AppController
{	
	   public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        //$this->Authentication->allowUnauthenticated(['test']);
        $this->Authentication->addUnauthenticatedActions(['view','test','reply']);
    }
	public function initialize(): void
	{	

		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Include the FlashComponent
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Math');
		
	}	

	public function test($id)
	{
		$query = $this->Articles->find()->where(['id' => $id])->all('assoc');
		//$reply = $this->Articles;
	
		foreach ($query as $key => $value) {
			echo $value;
		}


		$this->Authorization->skipAuthorization();
		$connection = ConnectionManager::get('test');
		$results = $connection->execute('SELECT * FROM event')->fetchAll('assoc');
		foreach ($results as $key => $value) {
			pr($value);
		}
		//echo($results);
		//pr($results);
		
		//$article = $this->Articles;
		//$this->set('test',$article);
		echo $this->Math->doComplexOperation(1,2);


	}


	public function index()
	{
		
		//$service = $this->request->getAttribute('authentication')->getAuthenticationProvider();
		$service = $this->request->getAttribute('authentication')->getResult()->isValid();
		pr($service);

	
		$user = $this->request->getAttribute('identity');
		//pr($user);
		//echo $user->get('email');
		$articles = $user->applyScope('index',$this->Articles->find('all')->contain("Tags"));
		

		$tags = $this->getTableLocator()->get("Tags");
		//pr($tags);

		//send data to view
		$this->set('articles',$articles);
		$this->viewBuilder()->setOption('serialize', ['articles']);
		//pr($this->request);
		//pr($this->add());
		

		
	}

	public function reply()
	{
	$this->Authorization->skipAuthorization();
	$reply = $this->Articles->newEmptyEntity();
	$reply->user_id = $this->request->getAttribute('identity')->getIdentifier();
	
	if ($this->request->is('post')) 
	{
	$reply = $this->Articles->patchEntity($reply,$this->request->getData());
	
	if ($this->Articles->save($reply)) 
		{	
		$this->Flash->success(__('success'));
		return $this->redirect(['action' => 'index']);
		} else {
		$this->Flash->error(__('Unable to add your article.'));
		}		
	}

	}

	public function view($slug = null)
	{
	$this->Authorization->skipAuthorization();
	$article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
	$test = $this->Articles;

	$this-> set('test',$test);
	$this->set(compact('article'));

	$reply = $this->Articles->newEmptyEntity();
	$this->set('reply',$reply);
	//pr($article);
	//
	}

	public function add()
	{
	$article = $this->Articles->newEmptyEntity();
	pr($article);
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
		
		$this->request->allowMethod(['post', 'delete']);
		$article = $this->Articles->findBySlug($slug)->firstOrFail();
		$this->Authorization->authorize($article);

		if ($this->Articles->delete($article)) 
		{
			$this->Flash->success(__('The {0} article has been deleted.', $article->→title));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function tags(...$tags)
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