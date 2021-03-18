

<h1>Add Article</h1>
<?php
echo $this->Form->create($article);
// Hard code the user for now.
echo $this->Form->control('user_id', ['type' => 'hidden']);
echo $this->Form->control('title');

echo $this->Form->control('body', array(
    
    'id'=>'summernote'
   
));

echo $this->Form->button(__('Save Article'));
echo $this->Form->control('tags._ids', [
	'type' => 'select',
	'multiple' => true,
	'options' => $tags]);
echo $this->Form->end();
?>

