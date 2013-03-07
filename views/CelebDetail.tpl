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
  
  {if isset($response->info["Politician"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsepolitician">
        Politics
      </a>
    </div>
    <div id="collapsepolitician" class="accordion-body collapse">
      <div class="accordion-inner">
      	<table class="table table-striped">
      		<tr>
					<th>Title</th>
					<th>Governmental Body</th>
					<th>Jurisdiction Of Office</th>
					<th>Position</th>
					<th>From</th>
					<th>To</th>
				</tr>
	        {foreach from=$response->info["Politician"] item=item}
	        	{if {$item["year"]} != "/"}
				<tr>
					<td>{$item["basic_title"]}</td>
					<td>{$item["governmental_body"]}</td>
					<td>{$item["jurisdiction_of_office"]}</td>
					<td>{$item["office_position_or_title"]}</td>
					<td>{$item["from"]}</td>
					<td>{$item["to"]}</td>
				</tr>
				{/if}
			{/foreach}
		</table>
      </div>
    </div>
  </div>
  {/if}
  
  {if isset($response->info["Olympics"]["awards"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseolympics">
        Olympics
      </a>
    </div>
    <div id="collapseolympics" class="accordion-body collapse">
      <div class="accordion-inner">
      	<table class="table table-striped">
      		<tr>
					<th>Medal</th>
					<th>Country</th>
					<th>Event</th>
					<th>Olympics</th>
				</tr>
	        {foreach from=$response->info["Olympics"]["awards"] item=item}
	        	{if {$item["year"]} != "/"}
				<tr>
					<td>{$item["medal"]}</td>
					<td>{$item["country"]}</td>
					<td>{$item["event"]}</td>
					<td>{$item["olympics"]}</td>
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
      	{if isset($response->info["Music"]["album"])}
        <h4>Albums</h4>
        =>
        {foreach from=$response->info["Music"]["album"] item=item}
		{$item}, &nbsp;
		{/foreach}
		{/if}
		<hr/>
		{if isset($response->info["Music"]["track"])}
		<h4>Tracks</h4>
        =>
        {foreach from=$response->info["Music"]["track"] item=item}
		{$item}, &nbsp;
		{/foreach}
		<hr/>
		{/if}
		{if isset($response->info["Music"]["genre"])}
		<h4>Genre</h4>
        =>
        {foreach from=$response->info["Music"]["genre"] item=item}
		{$item}, &nbsp;
		{/foreach}
		{/if}
      </div>
    </div>
  </div>
  {/if}
  
  {if isset($response->info["Book"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsebook">
        Works Written
      </a>
    </div>
    <div id="collapsebook" class="accordion-body collapse">
      <div class="accordion-inner">
      	{if isset($response->info["Book"]["works_written"])}
        {foreach from=$response->info["Book"]["works_written"] item=item}
		{$item}, &nbsp;
		{/foreach}
		{/if}
      </div>
    </div>
  </div>
  {/if}
  
  {if isset($response->info["Celebrities"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsecelebrities">
        Celebrity Life
      </a>
    </div>
    <div id="collapsecelebrities" class="accordion-body collapse">
      <div class="accordion-inner">
      	{if isset($response->info["Celebrities"]["celebrity_friends"][0])}
        <h4>Friends</h4>
        {foreach from=$response->info["Celebrities"]["celebrity_friends"] item=item}
			{if $item[0] != $response->info['Basic']['name']}
				{$item[0]}, &nbsp;
			{/if}
			{if $item[1] != $response->info['Basic']['name']}
				{$item[1]}, &nbsp;
			{/if}
		{/foreach}
        
		{/if}
		<hr/>
		{if isset($response->info["Celebrities"]["net_worth"][0])}
		<h4>Worth</h4>
        <b>Amount</b>:{$response->info["Celebrities"]["net_worth"][0]["amount"]}<br/>
        <b>Currency</b>:{$response->info["Celebrities"]["net_worth"][0]["currency"]}
		<hr/>
		{/if}
		{if isset($response->info["Celebrities"]["sexual_relationships"])}
		<h4>Relationships</h4>
        	<table class="table table-striped">
      		<tr>
      			<th>With</th>
      			<th>Relationship type</th>
      			<th>Start Date</th>
				<th>End Date</th>
				</tr>
	        {foreach from=$response->info["Celebrities"]["sexual_relationships"] item=item}
				<tr>
					<td>
						{if ($item["celebrity"][0] != $response->info['Basic']['name'])}
							{$item["celebrity"][0]}
						{/if}
						{if ($item["celebrity"][1] != $response->info['Basic']['name'])}
							{$item["celebrity"][1]}
						{/if}
					</td>
					<td>{$item["relationship_type"]}</td>
					<td>{$item["start_date"]}</td>
					<td>{$item["end_date"]}</td>
				</tr>
			{/foreach}
		</table>
		{/if}
      </div>
    </div>
  </div>
  {/if}  
</div>
	
{if isset($response->info["Cricket"])}
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsecricket">
        Cricket Info
      </a>
    </div>
    <div id="collapsecricket" class="accordion-body collapse">
      <div class="accordion-inner">
      	<b>Batting Style</b>:{$response->info["Cricket"]["batting_style"]}<br/><br/>
      	{if isset($response->info["Cricket"]["odi_stats"])}
      	<h4>ODI Stats</h4>
		{foreach from=$response->info["Cricket"]["odi_stats"] key=key item=item}
      		{if (($key != "attribution")&&($key != "creator")&&($key != "debut")&&($key != "guid")&&($key != "id")&&($key != "key")&&($key != "mid")&&($key != "name")&&($key != "permission")&&($key != "search")&&($key != "timestamp")&&($key != "type"))}
      			<b>{$key}</b>:{$item}<br/>
      		{/if}
		{/foreach}
		{/if}
		{if isset($response->info["Cricket"]["test_stats"])}
		<br/>
      	<h4>Test Stats</h4>
      	{foreach from=$response->info["Cricket"]["test_stats"] key=key item=item}
      		{if (($key != "attribution")&&($key != "creator")&&($key != "debut")&&($key != "guid")&&($key != "id")&&($key != "key")&&($key != "mid")&&($key != "name")&&($key != "permission")&&($key != "search")&&($key != "timestamp")&&($key != "type"))}
      			<b>{$key}</b>:{$item}<br/>
      		{/if}
		{/foreach}
		{/if}
      </div>
    </div>
  </div>
  {/if}
	
	</div>
</div>