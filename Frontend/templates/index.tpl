{extends './abstract/content.tpl'}
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
				<label class="nowrap">{$operation->getHumanName()}
					<input type="radio" class="display_trigger_name_{$operation->getOptionMask()}" id="operation_{$operation->getOptionMask()}" name="operation" value="{$operation->getOptionMask()}"{if $operation->getOptionMask() == $formStatesHistory->resolveValue('operation', $operation->getOptionMask())} {/if}{if $smarty.foreach.operations.last} checked="checked" {/if}/>&nbsp;
				</label>
{if count($operation->getListOfExtendingSettings()) > 0}
				<ul class="display_on_trigger_name_{$operation->getOptionMask()} operation_extended_settings" id="operation_extended_settings_{$operation->getOptionMask()}">
{foreach $operation->getListOfExtendingSettings() item=extendedSetting}
					<li class="plain-tooltip operation-extended-setting" onmouseover="showTooltipText(this, '{$extendedSetting->getNote()->getHumanName()}{if $extendedSetting->getNote()->getValue() !== ''} {$extendedSetting->getNote()->getValue()}{/if}');">
						<label class="nowrap">{$extendedSetting->getHumanName()}<textarea class="float-right" name="{$extendedSetting->getCode()}" rows="1" cols="20">{$formStatesHistory->resolveValue($extendedSetting->getCode(), $extendedSetting->getValue())}</textarea>
						</label>
					</li>
{/foreach}
				</ul>
{/if}
			</div>
{/foreach}
		</div>
		<hr />
		<div>
			<h3><label>{$consequence->getMaximalCtValue()->getHumanName()}</label></h3>
			Pokud {$consequence->getMaximalCtValue()->getHumanName()} dosáhne
			<select name="optional[{$consequence->getMaximalCtValue()->getCode()}]">
				<option value="{$consequence->getMaximalCtValue()->getValue()}">{$consequence->getMaximalCtValue()->getValue()}</option>
			</select>, pak {$consequence->getRqValueEdge()->getHumanName()} je
				<input type="text" name="optional[{$consequence->getRqValueEdge()->getCode()}]" value="{$formStatesHistory->resolveValue($consequence->getRqValueEdge()->getCode(), $consequence->getRqValueEdge()->getValue())}" size="5" />
			a každá
			<ul>
				<li>{$consequence->getReplacementValueUnderMaximum()->getHumanName()} bude
					<select name="optional[{$consequence->getReplacementValueUnderMaximum()->getCode()}]">
						<option value="{$consequence->getReplacementValueUnderMaximum()->getValue()}">{$consequence->getReplacementValueUnderMaximum()->getValue()}</option>
					</select>
				</li>
				<li>{$consequence->getReplacementValueOverMaximum()->getHumanName()} bude
					<select name="optional[{$consequence->getReplacementValueOverMaximum()->getCode()}]">
						<option value="{$consequence->getReplacementValueOverMaximum()->getValue()}">
							{if $consequence->getReplacementValueOverMaximum()->getValue() == ''}
								{">>prázný řetězec<<"}
							{else}
								{$consequence->getReplacementValueOverMaximum()->getValue()}
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
					{$measurementSetting->getHumanName()}:&nbsp;<input type="text" name="optional[{$measurementSettingsRegistry.code}][{$measurementSetting->getCode()}]" value="{$formStatesHistory->resolveArrayValue($measurementSettingsRegistry.code, $measurementSetting->getCode(), $measurementSetting->getValue())}" size="10" />
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
	{if isset($footerJs)}
		{foreach from=$footerJs item=jsFile}
				<script type="text/javascript" src="js/{$jsFile}"></script>
		{/foreach}
	{/if}
{/block}