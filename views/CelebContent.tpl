<div class="container">
	<div class="span9">
		{foreach from=$response->basicinfo item=person}
		<div class="span4">
			<div class="row basiccontainer thumbnail">
				<div class="span2">
					<a href="CelebDetail?id={$person['_id']}"><img src="http://api.freebase.com/api/trans/image_thumb/{$person['image'][0]}" alt="image"></a>
				</div>
				<div class="span2">
					Name : <b>{$person["name"]}</b>{if isset($person["alias"][0])} aka {$person["alias"][0]} {/if}
					<br/>
					Date of Birth : {$person["date_of_birth"]}
					<br/>
					{foreach from=$person["profession"] item=h} {$h},{/foreach}
				</div>
				<div class="span4">
					{$person["official_website"][0]}
					<br/>
					{$person["article"][0]|truncate:200}
					<br/>
				</div>
			</div>
		</div>
		{/foreach}
	</div>
</div>
