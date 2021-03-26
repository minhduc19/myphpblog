<!-- File: src/Template/Articles/index.ctp -->

<?php
  //pr($articles);
  $cell = $this->cell('Inbox');
?>

<?= $cell ?>
	<h1>Articles</h1>
	<?= $this->Html->link('Add Article', ['action' => 'add']) ?>
		<table>
			<tr>
				<th>Title</th>
				<th>Created</th>
			</tr>
				<!-- Here is where we iterate through our $articles query object, printing out
				˓→article info -->
				<?php foreach ($articles as $article): ?>
			<tr id = <?= $article->id ?>>
				<td>
				<?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
				</td>
				<td>
				<?= $article->created->format(DATE_RFC850) ?>
				</td>
				<td>
				<?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
				</td>
				<td>
				<?= $this->Form->postLink('Delete',['action' => 'delete', $article->slug],['confirm' => 'Are you sure?'])?>
				</td>
				<td>
				<?= $this->Form->button(__('test'),['id' => $article->id,'class' => 'delete']);?>
				</td>
			</tr>
	<?php endforeach; ?>
</table>
<?= $this->Form->button(__('Save Article'),['id' => 'cakebutton']);?>


<script>
/*
$(function (){
	$('#101').click(function(){
		$('#101').remove();
	});
});
*/

$(function(){
	$("button.delete").click(function(){
		var del_id = $(this).attr('id');
		var del_element = $(this).parent().parent();
		//alert(del_element);
		del_element.remove();
		$.ajax({
			type: 'POST',
			url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'ajaxRemove'])?>",
			data:{del_id:del_id},
			headers: {
					'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
				}

		});
	})
})



	$(function () {
		$('#cakebutton').click(function(){
			//alert('test');
			$.ajax({
				method: "GET",
				url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'receive'])?>",
				data: {
					id:10
				},
				headers: {
					'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
				}
			});
		});
	});
</script>
