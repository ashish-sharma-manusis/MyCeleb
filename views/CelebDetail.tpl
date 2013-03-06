<div class="container">
	<div class="span9">
		
		<div class="featurette">
        <img class="featurette-image pull-right" src="http://api.freebase.com/api/trans/image_thumb/{$response->info["Common"]['image'][0]}">
        <h2 class="featurette-heading">{$response->info["Basic"]["name"]}<span class="muted">  {foreach from=$response->info["Basic"]['profession'] item=h} {$h},{/foreach}</span></h2>
        <p class="lead">{$response->info["Common"]['article'][0]}</p>
      </div>

		
		<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsebasic">
        Basic Info.
      </a>
    </div>
    <div id="collapsebasic" class="accordion-body collapse in">
      <div class="accordion-inner">
        <b>D.O.B</b>: {$response->info["Basic"]['date_of_birth']}<br/>
        {if isset($response->info["Basic"]["ethnicity"][0])}
        <b>Ethnicity</b>: {foreach from=$response->info["Basic"]['ethnicity'] item=h} {$h},{/foreach}<br/>
        {/if}
        <b>Gender</b>: {$response->info["Basic"]['gender']}<br/>
        {if isset($response->info["Basic"]["height_meters"])}
        <b>Height(m)</b>: {$response->info["Basic"]['height_meters']}<br/>
        {/if}
        {if isset($response->info["Basic"]["weight_kg"])}
        <b>Weight(kg)</b>: {$response->info["Basic"]['weight_kg']}<br/>
        {/if}
        <b>Nationality</b>: {$response->info["Basic"]['nationality'][0]}<br/>
        {if isset($response->info["Basic"]["children"][0])}
        <b>Children</b>: {foreach from=$response->info["Basic"]['children'] item=h} {$h},{/foreach}<br/>
        {/if}
      </div>
    </div>
  </div>
  
  {if isset($response->info["Award"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseaward">
        Awards
      </a>
    </div>
    <div id="collapseaward" class="accordion-body collapse">
      <div class="accordion-inner">
      	<table class="table table-striped">
      		<tr>
					<th>Year</th>
					<th>Award Category</th>
					<th>Winning work</th>
					<th>Ceremony</th>
				</tr>
	        {foreach from=$response->info["Award"] item=item}
	        	{if {$item["year"]} != "/"}
				<tr>
					<td>{$item["year"]}</td>
					<td>{$item["award"]}</td>
					<td>{$item["honored_for"][0]}</td>
					<td>{$item["ceremony"]}</td>
				</tr>
				{/if}
			{/foreach}
		</table>
      </div>
    </div>
  </div>
  {/if}
  
  {if isset($response->info["Film"]["film"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsefilm">
        Film
      </a>
    </div>
    <div id="collapsefilm" class="accordion-body collapse">
      <div class="accordion-inner">
      	=>
        {foreach from=$response->info["Film"]["film"] item=item}
		{$item["film_name"]}, &nbsp;
		{/foreach}
      </div>
    </div>
  </div>
  {/if}
  
  {if isset($response->info["Music"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsemusic">
        Music
      </a>
    </div>
    <div id="collapsemusic" class="accordion-body collapse">
      <div class="accordion-inner">
        <h4>Albums</h4>
        =>
        {foreach from=$response->info["Music"]["album"] item=item}
		{$item}, &nbsp;
		{/foreach}
		<hr/>
		<h4>Tracks</h4>
        =>
        {foreach from=$response->info["Music"]["track"] item=item}
		{$item}, &nbsp;
		{/foreach}
		<hr/>
		<h4>Genre</h4>
        =>
        {foreach from=$response->info["Music"]["genre"] item=item}
		{$item}, &nbsp;
		{/foreach}
      </div>
    </div>
  </div>
  {/if}
  
</div>
	
	</div>
</div>