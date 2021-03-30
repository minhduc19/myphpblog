  <div class="row">    
    <div class="input-field col s8 m8 l4 offset-l3">
      <input value="" id="first_name2" type="text" class="validate">
      <label class="active" for="first_name2">Type your email</label>
    </div>
    <div class="input-field col s4 m4 l2">
      <a class="waves-effect waves-light btn">Subscribe</a>
    </div>
  </div>

				<!-- Here is where we iterate through our $articles query object, printing out
				˓→article info -->
				<?php foreach ($articles as $article): ?>
					<h5 id = <?= $article->id ?>><?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?></h5>
					
				<?php endforeach; ?>





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
		
		$.ajax({
			type: 'POST',
			url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'ajaxRemove'])?>",
			data:{del_id:del_id},
			headers: {
					'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
				},
			success: function(data){
				if(data == "yes"){
				del_element.remove();
				}
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




