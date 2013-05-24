{extends 'abstract/content.tpl'}
{block "page-content"}
<form method='post' action='process.php' enctype='multipart/form-data'>
	<fieldset>
		<legend class="blue-shadow">Výpočet a řazení relativní kvantifikace</legend>
		<h3>Výběr souboru</h3>
		<span class="plain-tooltip" onmouseover="showTooltip(this, 'inputFileFormat');">
			<input type='file' name='{$inputFileName}' />
			Textový soubor se vstupními hodnotami (s údaji oddělenými tabulátorem)
		</span><br />
		<hr />
		<div id='operationSet'>
			<h3>Určení obsahu souboru</h3>
{foreach from=$operationList item=operation name=operations}
			<div class="half-width operation">
				<label class="nowrap">{$operation->humanName}
					<input type="radio" class="display_trigger_name_{$operation->optionMask}" id="operation_{$operation->optionMask}" name="operation" value="{$operation->optionMask}"{if $operation->optionMask == $formStatesHistory->resolveValue('operation', $operation->optionMask)} {/if}/>&nbsp;
				</label>
{if $operation->listOfExtendingSettings}
				<ul class="display_on_trigger_name_{$operation->optionMask} operation_extended_settings" id="operation_extended_settings_{$operation->optionMask}">
{foreach $operation->listOfExtendingSettings item=extendedSetting}
					<li class="plain-tooltip operation-extended-setting" onmouseover="showTooltipText(this, '{$extendedSetting->note->humanName}{if $extendedSetting->note->value !== ''} {$extendedSetting->note->value}{/if}');">
						<label class="nowrap">{$extendedSetting->humanName}<textarea class="float-right" name="{$extendedSetting->code}" rows="1" cols="20">{$formStatesHistory->resolveValue($extendedSetting->code, $extendedSetting->value)}</textarea>
						</label>
					</li>
{/foreach}
				</ul>
{/if}
			</div>
{/foreach}
		<hr />
		<div>
			<h3><label>{$consequence->maximalCtValue->humanName}</label></h3>
			Pokud {$consequence->maximalCtValue->humanName} dosáhne
			<select name="optional[{$consequence->maximalCtValue->code}]">
				<option value="{$consequence->maximalCtValue->value}">{$consequence->maximalCtValue->value}</option>
			</select>, pak {$consequence->rqValueEdge->humanName} je
				<input type="text" name="optional[{$consequence->rqValueEdge->code}]" value="{$formStatesHistory->resolveValue($consequence->rqValueEdge->code, $consequence->rqValueEdge->value)}" size="5" />
			a každá
			<ul>
				<li>{$consequence->replacementValueUnderMaximum->humanName} bude
					<select name="optional[{$consequence->replacementValueUnderMaximum->code}]">
						<option value="{$consequence->replacementValueUnderMaximum->value}">{$consequence->replacementValueUnderMaximum->value}</option>
					</select>
				</li>
				<li>{$consequence->replacementValueOverMaximum->humanName} bude
					<select name="optional[{$consequence->replacementValueOverMaximum->code}]">
						<option value="{$consequence->replacementValueOverMaximum->value}">
							{if $consequence->replacementValueOverMaximum->value == ''}
								{">>prázný řetězec<<"|escape}
							{else}
								{$consequence->replacementValueOverMaximum->value}
							{/if}
							</option>
					</select>
				</li>
			</ul>
		</div>
		<hr />
		<div>
			<h3>{$measurementSettingsRegistry.name}</h3>
			{foreach from=$measurementSettings item=measurementSetting}
				<label>
					{$measurementSetting->humanName}:&nbsp;<input type="text" name="optional[{$measurementSettingsRegistry.code}][{$measurementSetting->code}]" value="{$formStatesHistory->resolveArrayValue($measurementSettingsRegistry.code, $measurementSetting->code, $measurementSetting->value)}" size="10" />
				</label>
			{/foreach}
		</div>
		<hr />
		<input type='checkbox' checked='checked' name='smazaniJmenLidi' disabled='disabled' /> Po separaci dat podle genu automaticky smazat sloupce se jmény lidí, mimo prvního sloupce se jmény lidí<br />
		<hr />
		<input type='checkbox' checked='checked' name='presunNazvuGenuDoHlavicky' disabled='disabled' /> Automatické přesunutí názvu genů ze sloupce do hlavičky<br />
		<input type='checkbox' checked='checked' name='pridaniZkratekObsahuDoHlavickyGenu' disabled='disabled' /> Automatické přidání do hlavičky k názvům genů dodatky Ct a RQ<br />
		<hr />
		<input type='submit' value='Seřaď data' class='float-right' />
	</fieldset>
</form>
<div id="file-history">
	<a href="./history.php">Zobrazit historii</a>
</div>
{/block}
{block "footer"}
<span id="footer">
	{if isset($footerJs)}
		{foreach from=$footerJs item=jsFile}
				<script type="text/javascript" src="js/{$jsFile}"></script>
		{/foreach}
	{/if}
</span>
{/block}