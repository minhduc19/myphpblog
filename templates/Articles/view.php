<p><b>Tags:</b> <?= h($article->tag_string) ?></p>
<?php pr($article) ?>
<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>

<h2>Answer post</h2>
<?= $this->Form->create($reply, ['url' => ['controller' => 'answers','action' => 'add']]);?>
<?= $this->Form->control('article_id', ['type' => 'hidden', 'value' => $article->id]); ?>
<?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]); ?>
<?= $this->Form->control('body', array(
    
    'id'=>'summernote'
   
)); ?>
<?= $this->Form->button(__('Answer')); ?>
<?= $this->Form->end(); ?>