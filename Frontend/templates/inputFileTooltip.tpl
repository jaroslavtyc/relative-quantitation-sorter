<div id="columnsContentSet">
	<h4>Vyžadovaná posloupnost sloupců</h4>
	<ol>
{foreach from=$columnsPurpose item=purpose}
		<li id="{key($purpose)}"><span class="possibility-name">{current($purpose)}</span></li>
{/foreach}
	</ol>
</div>