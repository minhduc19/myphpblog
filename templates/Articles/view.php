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

<?php foreach($article->answers as $key => $value)	{
		echo "<div>";
		echo $value->body;
		echo "</div>";
		echo "<span>".$this->Html->link('Edit', ['controller' => 'answers','action' => 'edit', $value->id])."</span>";
		echo $this->Form->postLink('Delete',['controller' => 'answers','action' => 'delete', $value->id],['confirm' => 'Are you sure?']);
		echo "</span>";
	}?>


