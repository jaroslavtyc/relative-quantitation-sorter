{extends 'abstract/content.tpl'}
{block "page-content"}
<form method='POST' action='process.php' enctype='multipart/form-data'>
	<fieldset>
		<legend>Transformace informace</legend>
			<h4>Výběr souboru</h4>
			<span class="plain-tooltip" onmouseover="showTooltip(this, 'inputFileFormat');">
			<input type='file' name='{$inputFileName}'>
				Textový soubor se vstupními hodnotami (s údaji oddělenými tabulátorem)
			</input></span><br />
			<hr />
			<table id='operationSet'>
				<thead>
					<tr>
						<th><h4>Určení obsahu souboru</h4></th>
					</tr>
				</thead>
				<tbody>
					<tr>
{foreach from=$operationList item=operation}
						<td>
							<label>{$operation->humanName}
								<input id="{$operation->optionMask}" type="radio" name="operation" value="{$operation->optionMask}"{if $operation->optionMask == $formStatesHistory->resolveValue('operation', $operation->optionMask)}checked="checked"{/if} />&nbsp;
							</label>
	{if $operation->listOfExtendingSettings}
							<ul id="{$operation->optionMask}_extended_settings">
		{foreach $operation->listOfExtendingSettings item=extendedSetting}
								<li>
									<label>{$extendedSetting->humanName}
										<textarea name="{$extendedSetting->code}">{$formStatesHistory->resolveValue($extendedSetting->code, $extendedSetting->value)}</textarea>
			{if $extendedSetting->note}
										<span>({$extendedSetting->note->humanName}{if $extendedSetting->note->value !== ''} "{$extendedSetting->note->value}"{/if})</span>
			{/if}
									</label>
								</li>
		{/foreach}
	{/if}
						</td>
{/foreach}
					</tr>
				</tbody>
			</table>
			<hr />
			<div id="{ConsequencesOfMaximalCtValue::CODE}">
				<h4>
					<label>
						<input type='checkbox' checked='true' name='{ConsequencesOfMaximalCtValue::CODE}' disabled='disabled' />
						<span>{ConsequencesOfMaximalCtValue::HUMAN_NAME}</span>
					</label>
				</h4>
				Pokud {$consequence->maximalCtValue->humanName} dosáhne
				<select name="{$consequence->maximalCtValue->code}">
					<option value="{$consequence->maximalCtValue->value}">{$consequence->maximalCtValue->value}</option>
				</select>, pak {$consequence->rqValueEdge->humanName} je
					<input type="text" name="{$consequence->rqValueEdge->code}" value="{$formStatesHistory->resolveValue($consequence->rqValueEdge->code, $consequence->rqValueEdge->value)}" size="5"/>
				a každá
				<ul>
					<li>{$consequence->replacementValueUnderMaximum->humanName} bude
						<select name="{$consequence->replacementValueUnderMaximum->code}">
							<option value="{$consequence->replacementValueUnderMaximum->value}">{$consequence->replacementValueUnderMaximum->value}</option>
						</select>
					</li>
					<li>{$consequence->replacementValueOverMaximum->humanName} bude
						<select name="{$consequence->replacementValueOverMaximum->code}">
							<option value="{$consequence->replacementValueOverMaximum->value}">
								{if $consequence->replacementValueOverMaximum->value == ''}
									>>prázný řetězec<<
								{else}
									{$consequence->replacementValueOverMaximum->value}
								{/if}
								</option>
						</select>
					</li>
				</ul>
			</div>
			<hr />
			<div id="{MeasurementSettingsToKeep::CODE}">
				<h4>{MeasurementSettingsToKeep::HUMAN_NAME}</h4>
				{foreach from=$measurementSettings item=measurementSetting}
					<label>
						{$measurementSetting->humanName}:&nbsp;<input type="text" name="{MeasurementSettingsToKeep::CODE}[{$measurementSetting->code}]" value="{$formStatesHistory->resolveArrayValue(MeasurementSettingsToKeep::CODE, $measurementSetting->code, $measurementSetting->value)}" size="10"/>
					</label>
				{/foreach}
			</div>
			<hr />
			<input type='checkbox' checked='true' name='smazaniJmenLidi' disabled='disabled' /> Po separaci dat podle genu automaticky smazat sloupce se jmény lidí, mimo prvního sloupce se jmény lidí</input><br />
			<hr />
			<input type='checkbox' checked='true' name='presunNazvuGenuDoHlavicky' disabled='disabled' /> Automatické přesunutí názvu genů ze sloupce do hlavičky</input><br />
			<input type='checkbox' checked='true' name='pridaniZkratekObsahuDoHlavickyGenu' disabled='disabled' /> Automatické přidání do hlavičky k názvům genů dodatky Ct a RQ</input><br />
			<hr />
			<input type='submit' value='Seřaď data' class='fr'></input>
		</legend>
	</fieldset>
</form>
<div id="file-history">
	<a href="./history.php">Zobrazit historii</a>
</div>
{literal}
	<script type="text/javascript">
		var tooltips = [];
		function showTooltip(element, tooltipName) {
			if (!(tooltipName in tooltips)) {
				var currentUrl = window.location.href;
				var baseUrl = currentUrl.replace(/[/][^/]+$/, '');
				var tooltipUrl =  baseUrl + '/tooltips.php?tooltip=' + tooltipName;
				(function($){
					$(element).each(function(index, wrapped) {
						tooltips[tooltipName] = new Opentip(wrapped, { ajax: tooltipUrl, cache: true});
					});
					$(element).trigger('mouseover');
				}(jQuery));
			}
		}
	</script>
{/literal}
{/block}
{block "footer"}
	{literal}
<div id="gt">
	<div id="google_translate_element" style="display: block"></div>
	<script>
		function googleTranslate() {
			new google.translate.TranslateElement({pageLanguage: "{/literal}{#lang#}{literal}"}, "google_translate_element");
		};
	</script>
	<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslate"></script>
</div>
	{/literal}
{/block}