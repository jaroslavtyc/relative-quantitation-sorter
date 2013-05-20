{extends 'abstract/content.tpl'}
{block "page-content"}
<table id="file-history">
	<thead>
		<tr>
			<th>
				Datum
			</th>
			<th>
				Zdrojový soubor
			</th>
			<th colspan="2">
				Velikost zdrojového souboru
			</th>
			<th>
				Výsledný soubor
			</th>
			<th colspan="2">
				Velikost výsledného soubor
			</th>
		</tr>
	</thead>
	<tbody>
	{foreach from=$history->listOfFiles key=unixstamp item=sameTimeFiles}
		{foreach from=$sameTimeFiles key=tempName item=sameTimeTempnameFiles}
		<tr>
			<td class="tal">
			{$unixstamp|date_format:"j.n. Y G:i:s"}
			</td>
			{foreach from=$sameTimeTempnameFiles key=historyType item=fileInfo}
				{assign var=formatedSize value=FileUtilities::makeFormatedSize($fileInfo.size)}
			<td  class="tac">
				<a href=".{FileHistoryUtilities::createFileUrl($historyType, $unixstamp, $tempName, $fileInfo)}">{$fileInfo.name}</a>
			</td>
			<td class="tar">
				{$formatedSize.size}
			</td>
			<td  class="tal">
				{$formatedSize.unit}
			</td>
			{/foreach}
		</tr>
		{/foreach}
	{/foreach}
	</tbody>
</table>
{/block}