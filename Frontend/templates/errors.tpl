{if !empty($errors)}
	<div class="errors" id="{$errorsAnchorName}">
		<span class="errors-count">Celkem chyb: {$errorsCount}</span><hr />
		{assign var=shownMessagesCount value=0}
		{foreach $errors key=groupName item=groupMessages}
		{assign var=shownMessagesCount value=$shownMessagesCount+sizeof($groupMessages)}
		<h4>{$groupName} ({$shownMessagesCount} z {$errorsCount}):</h4>
		<ul>
			{foreach $groupMessages as $message}
			<li>{$message}</li>
			{/foreach}
		</ul>
		{/foreach}
	</div>
{/if}