<p><b>Tags:</b> <?= h($article->tag_string) ?></p>
<?php //pr($article) ?>
<h1><?= $article->title ?></h1>
<p><?= $article->body ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>

<?= $this->Form->create($answer, ['url' => ['controller' => 'answers','action' => 'add']]);?>
<?= $this->Form->control('article_id', ['type' => 'hidden', 'value' => $article->id]); ?>

<?= $this->Form->control('body', array(
    
    'id'=>'summernote', 'label' => false
   
)); ?>
<?= $this->Form->button(__('Answer')); ?>
<?= $this->Form->end(); ?>

 <div class="col s12 m7">
<?php foreach($article->answers as $key => $value)	{
		echo "<div class='card horizontal'>";
			echo "<div class='card-stacked'>";
				echo "<div class='card-stacked'>";
					echo "<div class='card-content'>";
						echo $value->body;
					echo "</div>";
					
				
						if($user != null && $user->can('edit', $value)){
							echo "<div class='card-action'>";
							echo $this->Html->link('Edit', ['controller' => 'answers','action' => 'edit', $value->id]);
							echo "</div>";
						}

						//echo $this->Form->postLink('Delete',['controller' => 'answers','action' => 'delete', $value->id],['confirm' => 'Are you sure?']);
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}?>
</div>

  