<p><b>Tags:</b> <?= h($article->tag_string) ?></p>
<?php pr($article) ?>
<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>

<h2>Reply to this post</h2>
<?= $this->Form->create($reply, ['url' => ['controller' => 'articles','action' => 'reply']]);?>
<?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $article->user_id]);?>
<?= $this->Form->control('replyto', ['type' => 'hidden','value' => $article->id]);?>
<?= $this->Form->control('title');?>
<?= $this->Form->control('body', array(
    
    'id'=>'summernote'
   
)); ?>
<?= $this->Form->control('community',['label' => 'Publish to community']);?>
<?= $this->Form->button(__('Reply')); ?>
<?= $this->Form->end(); ?>