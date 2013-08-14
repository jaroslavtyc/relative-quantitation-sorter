{extends './abstract/content.tpl'}
{block "page-content"}
	{if $user->isLoggedIn()}
		Uživatel přihlášen
	{else}
		<fieldset>
			<legend>Přihlášení</legend>
			<form action="" method="POST">
				<div><label>Jméno<input name="login" size="12" /></label></div>
				<div><label>Heslo<input name="password" type="password" size="12" /></label></div>
				<input type="submit" />
			</form>
		</fieldset>
	{/if}
{/block}