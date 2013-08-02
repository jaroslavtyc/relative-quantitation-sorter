{extends "./base.tpl"}
{block "allowed-content"}
	{block "page-content"}
	{/block}
	{block "errors"}
		{include file="../errors.tpl"}
	{/block}
	{block "footer"}
	{/block}
{/block}