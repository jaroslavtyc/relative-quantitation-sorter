{if !empty($errors)}
	<div class="errors" id="{$errorsAnchorName}">
		<span class="errors-count">Celkem chyb: {$errorsCount}</span><hr />
		{foreach $errors key=groupName item=groupMessages}
		<h4>{$groupName} ({sizeof($groupMessages)}/{$errorsCount}):</h4>
		<ul>
			{foreach $groupMessages as $message}
			<li>{$message}</li>
			{/foreach}
		</ul>
		{/foreach}
	</div>
{/if}