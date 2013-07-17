<?php /* Smarty version Smarty-3.1.7, created on 2013-05-24 15:30:12
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19915197c3fec33581-78060767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1369374858,
      2 => 'file',
    ),
    'd5203064105d23d74c8147ab5eb90a8c8c068016' => 
    array (
      0 => '.\\templates\\abstract\\content.tpl',
      1 => 1365668545,
      2 => 'file',
    ),
    '2ef9d14c847cd495542f574c8d5979abc8590553' => 
    array (
      0 => 'C:\\Users\\JT\\Dropbox\\Projects\\universal\\Base/../templates\\base.tpl',
      1 => 1369236245,
      2 => 'file',
    ),
    'b4a48d8b719c26643204b7d8128af06e1ab56540' => 
    array (
      0 => '.\\templates\\errors.tpl',
      1 => 1369380508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19915197c3fec33581-78060767',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5197c3ff4cddc',
  'variables' => 
  array (
    'css' => 0,
    'cssFile' => 0,
    'headerJs' => 0,
    'jsFile' => 0,
    'checks' => 0,
    'technologyCode' => 0,
    'allowContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5197c3ff4cddc')) {function content_5197c3ff4cddc($_smarty_tpl) {?><?php if (!is_callable('smarty_function_checks')) include 'C:\\Users\\JT\\Dropbox\\Projects\\universal\\Base/../extensions/smarty/plugins\\function.checks.php';
?>
	<?php  $_config = new Smarty_Internal_Config("base.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("checks", 'local'); ?>
	<?php echo smarty_function_checks(array('cookie'=>$_smarty_tpl->getConfigVariable('cookie_check'),'css'=>$_smarty_tpl->getConfigVariable('css_check'),'js'=>$_smarty_tpl->getConfigVariable('js_check'),'assign'=>'checks'),$_smarty_tpl);?>
 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


	<?php  $_config = new Smarty_Internal_Config("base.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("html", 'local'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getConfigVariable('xml_lang');?>
" lang="<?php echo $_smarty_tpl->getConfigVariable('lang');?>
">


	<?php  $_config = new Smarty_Internal_Config("base.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("head", 'local'); ?>
	<head>
		<title><?php echo $_smarty_tpl->getConfigVariable('title');?>
</title>
	   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta name="description" lang="<?php echo $_smarty_tpl->getConfigVariable('lang');?>
" content="<?php echo $_smarty_tpl->getConfigVariable('description');?>
" />
	<?php if (isset($_smarty_tpl->tpl_vars['css']->value)){?>
		<?php  $_smarty_tpl->tpl_vars['cssFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cssFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['css']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cssFile']->key => $_smarty_tpl->tpl_vars['cssFile']->value){
$_smarty_tpl->tpl_vars['cssFile']->_loop = true;
?>
		<link rel="stylesheet" type="text/css" media="all" href="css/<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>
" />
		<?php } ?>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['headerJs']->value)){?>
		<?php  $_smarty_tpl->tpl_vars['jsFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['headerJs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsFile']->key => $_smarty_tpl->tpl_vars['jsFile']->value){
$_smarty_tpl->tpl_vars['jsFile']->_loop = true;
?>
		<script type="text/javascript" src="js/<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>
"></script>
		<?php } ?>
	<?php }?>
	</head>

	<body>
<?php  $_config = new Smarty_Internal_Config("base.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("main_divs", 'local'); ?>
		<div<?php if ($_smarty_tpl->getConfigVariable('wrapper_div_class_name')){?> class='<?php echo $_smarty_tpl->getConfigVariable('wrapper_div_class_name');?>
'<?php }?><?php if ($_smarty_tpl->getConfigVariable('wrapper_div_id_name')){?> id='<?php echo $_smarty_tpl->getConfigVariable('wrapper_div_id_name');?>
'<?php }?>>
			<div<?php if ($_smarty_tpl->getConfigVariable('content_div_class_name')){?> class='<?php echo $_smarty_tpl->getConfigVariable('content_div_class_name');?>
'<?php }?><?php if ($_smarty_tpl->getConfigVariable('content_div_id_name')){?> id='<?php echo $_smarty_tpl->getConfigVariable('content_div_id_name');?>
'<?php }?>>

	<?php if ($_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['required']){?> 
		<?php $_smarty_tpl->tpl_vars['allowContent'] = new Smarty_variable(false, null, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['allowContent'] = new Smarty_variable(true, null, 0);?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['required']||$_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['required']||$_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['recommended']||$_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['recommended']){?>
				<div id="checks">
		<?php if ($_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['required']||$_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['required']){?> 
					<div class="checks" id="required-list">
			<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['required']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?> 
						<div class="required <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
-required"<?php if ($_smarty_tpl->tpl_vars['technologyCode']->value=='css'){?> style="display: none"<?php }?> >
							<h2>Pro zobrazení veškerého obsahu je nutné povolit <a href="/how_to_enable/?task=<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
#<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" title="návod na zprovoznění <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
</a></h2>
						</div>
			<?php } ?>
			<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['required']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?> 
						<div class="required <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
-required">
							<h2>Pro zobrazení obsahu je nutné povolit <a href="/how_to_enable/?task=<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
#<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" title="návod na zprovoznění <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
</a></h2>
						</div>
			<?php } ?>
					</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['recommended']||$_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['recommended']){?>
					<div class="checks" id="recommended-list">
			<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['unsupportedTechnologies']['recommended']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?>
						<div class="recommended <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
-recommended">
							<h3>Obsah nelze správně zobrazit kvůli chybějící podpoře <a href="/how_to_enable/?task=<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
#<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" title="návod na zprovoznění <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
</a></h3>
						</div>
			<?php } ?>
			<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['recommended']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?>
						<div class="recommended <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
-recommended"<?php if ($_smarty_tpl->tpl_vars['technologyCode']->value=='css'){?> style="display: none"<?php }?>>
							<h3>Obsah nelze správně zobrazit kvůli chybějící podpoře <a href="/how_to_enable/?task=<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
#<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
" title="návod na zprovoznění <?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
</a></h3>
						</div>
			<?php } ?>
					</div>
		<?php }?>
				</div>
	<?php }?>

<?php if ($_smarty_tpl->tpl_vars['allowContent']->value){?> 
	<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['required']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?>
				<span id="<?php echo $_smarty_tpl->tpl_vars['technologyCode']->value;?>
-required"<?php if ($_smarty_tpl->tpl_vars['technologyCode']->value!='css'){?> style="display: none"<?php }?>> 
	<?php } ?>
	
	
<form method='post' action='process.php' enctype='multipart/form-data'>
	<fieldset>
		<legend class="blue-shadow">Výpočet a řazení relativní kvantifikace</legend>
		<h3>Výběr souboru</h3>
		<span class="plain-tooltip" onmouseover="showTooltip(this, 'inputFileFormat');">
			<input type='file' name='<?php echo $_smarty_tpl->tpl_vars['inputFileName']->value;?>
' />
			Textový soubor se vstupními hodnotami (s údaji oddělenými tabulátorem)
		</span><br />
		<hr />
		<div id='operationSet'>
			<h3>Určení obsahu souboru</h3>
<?php  $_smarty_tpl->tpl_vars['operation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['operation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['operationList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['operation']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['operation']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['operation']->key => $_smarty_tpl->tpl_vars['operation']->value){
$_smarty_tpl->tpl_vars['operation']->_loop = true;
 $_smarty_tpl->tpl_vars['operation']->iteration++;
 $_smarty_tpl->tpl_vars['operation']->last = $_smarty_tpl->tpl_vars['operation']->iteration === $_smarty_tpl->tpl_vars['operation']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['operations']['last'] = $_smarty_tpl->tpl_vars['operation']->last;
?>
			<div class="half-width operation">
				<label class="nowrap"><?php echo $_smarty_tpl->tpl_vars['operation']->value->humanName;?>

					<input type="radio" class="display_trigger_name_<?php echo $_smarty_tpl->tpl_vars['operation']->value->optionMask;?>
" id="operation_<?php echo $_smarty_tpl->tpl_vars['operation']->value->optionMask;?>
" name="operation" value="<?php echo $_smarty_tpl->tpl_vars['operation']->value->optionMask;?>
"<?php if ($_smarty_tpl->tpl_vars['operation']->value->optionMask==$_smarty_tpl->tpl_vars['formStatesHistory']->value->resolveValue('operation',$_smarty_tpl->tpl_vars['operation']->value->optionMask)){?> <?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['operations']['last']){?> checked="checked" <?php }?>/>&nbsp;
				</label>
<?php if ($_smarty_tpl->tpl_vars['operation']->value->listOfExtendingSettings){?>
				<ul class="display_on_trigger_name_<?php echo $_smarty_tpl->tpl_vars['operation']->value->optionMask;?>
 operation_extended_settings" id="operation_extended_settings_<?php echo $_smarty_tpl->tpl_vars['operation']->value->optionMask;?>
">
<?php  $_smarty_tpl->tpl_vars['extendedSetting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['extendedSetting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['operation']->value->listOfExtendingSettings; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['extendedSetting']->key => $_smarty_tpl->tpl_vars['extendedSetting']->value){
$_smarty_tpl->tpl_vars['extendedSetting']->_loop = true;
?>
					<li class="plain-tooltip operation-extended-setting" onmouseover="showTooltipText(this, '<?php echo $_smarty_tpl->tpl_vars['extendedSetting']->value->note->humanName;?>
<?php if ($_smarty_tpl->tpl_vars['extendedSetting']->value->note->value!==''){?> <?php echo $_smarty_tpl->tpl_vars['extendedSetting']->value->note->value;?>
<?php }?>');">
						<label class="nowrap"><?php echo $_smarty_tpl->tpl_vars['extendedSetting']->value->humanName;?>
<textarea class="float-right" name="<?php echo $_smarty_tpl->tpl_vars['extendedSetting']->value->code;?>
" rows="1" cols="20"><?php echo $_smarty_tpl->tpl_vars['formStatesHistory']->value->resolveValue($_smarty_tpl->tpl_vars['extendedSetting']->value->code,$_smarty_tpl->tpl_vars['extendedSetting']->value->value);?>
</textarea>
						</label>
					</li>
<?php } ?>
				</ul>
<?php }?>
			</div>
<?php } ?>
		</div>
		<hr />
		<div>
			<h3><label><?php echo $_smarty_tpl->tpl_vars['consequence']->value->maximalCtValue->humanName;?>
</label></h3>
			Pokud <?php echo $_smarty_tpl->tpl_vars['consequence']->value->maximalCtValue->humanName;?>
 dosáhne
			<select name="optional[<?php echo $_smarty_tpl->tpl_vars['consequence']->value->maximalCtValue->code;?>
]">
				<option value="<?php echo $_smarty_tpl->tpl_vars['consequence']->value->maximalCtValue->value;?>
"><?php echo $_smarty_tpl->tpl_vars['consequence']->value->maximalCtValue->value;?>
</option>
			</select>, pak <?php echo $_smarty_tpl->tpl_vars['consequence']->value->rqValueEdge->humanName;?>
 je
				<input type="text" name="optional[<?php echo $_smarty_tpl->tpl_vars['consequence']->value->rqValueEdge->code;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['formStatesHistory']->value->resolveValue($_smarty_tpl->tpl_vars['consequence']->value->rqValueEdge->code,$_smarty_tpl->tpl_vars['consequence']->value->rqValueEdge->value);?>
" size="5" />
			a každá
			<ul>
				<li><?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueUnderMaximum->humanName;?>
 bude
					<select name="optional[<?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueUnderMaximum->code;?>
]">
						<option value="<?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueUnderMaximum->value;?>
"><?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueUnderMaximum->value;?>
</option>
					</select>
				</li>
				<li><?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueOverMaximum->humanName;?>
 bude
					<select name="optional[<?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueOverMaximum->code;?>
]">
						<option value="<?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueOverMaximum->value;?>
">
							<?php if ($_smarty_tpl->tpl_vars['consequence']->value->replacementValueOverMaximum->value==''){?>
								<?php echo htmlspecialchars(">>prázný řetězec<<", ENT_QUOTES, 'UTF-8', true);?>

							<?php }else{ ?>
								<?php echo $_smarty_tpl->tpl_vars['consequence']->value->replacementValueOverMaximum->value;?>

							<?php }?>
							</option>
					</select>
				</li>
			</ul>
		</div>
		<hr />
		<div>
			<h3><?php echo $_smarty_tpl->tpl_vars['measurementSettingsRegistry']->value['name'];?>
</h3>
			<?php  $_smarty_tpl->tpl_vars['measurementSetting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['measurementSetting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['measurementSettings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['measurementSetting']->key => $_smarty_tpl->tpl_vars['measurementSetting']->value){
$_smarty_tpl->tpl_vars['measurementSetting']->_loop = true;
?>
				<label>
					<?php echo $_smarty_tpl->tpl_vars['measurementSetting']->value->humanName;?>
:&nbsp;<input type="text" name="optional[<?php echo $_smarty_tpl->tpl_vars['measurementSettingsRegistry']->value['code'];?>
][<?php echo $_smarty_tpl->tpl_vars['measurementSetting']->value->code;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['formStatesHistory']->value->resolveArrayValue($_smarty_tpl->tpl_vars['measurementSettingsRegistry']->value['code'],$_smarty_tpl->tpl_vars['measurementSetting']->value->code,$_smarty_tpl->tpl_vars['measurementSetting']->value->value);?>
" size="10" />
				</label>
			<?php } ?>
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

	
		<?php /*  Call merged included template "errors.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '19915197c3fec33581-78060767');
content_519f878510da0($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "errors.tpl" */?>
	
	
	<?php if (isset($_smarty_tpl->tpl_vars['footerJs']->value)){?>
		<?php  $_smarty_tpl->tpl_vars['jsFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footerJs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsFile']->key => $_smarty_tpl->tpl_vars['jsFile']->value){
$_smarty_tpl->tpl_vars['jsFile']->_loop = true;
?>
				<script type="text/javascript" src="js/<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>
"></script>
		<?php } ?>
	<?php }?>


	
	
	<?php  $_smarty_tpl->tpl_vars['check'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['check']->_loop = false;
 $_smarty_tpl->tpl_vars['technologyCode'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checks']->value['uncheckableTechnologies']['required']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['check']->key => $_smarty_tpl->tpl_vars['check']->value){
$_smarty_tpl->tpl_vars['check']->_loop = true;
 $_smarty_tpl->tpl_vars['technologyCode']->value = $_smarty_tpl->tpl_vars['check']->key;
?>
				</span>
	<?php } ?>
<?php }?>
			</div>
		</div>

	<?php if (isset($_smarty_tpl->tpl_vars['footerJs']->value)){?>
		<?php  $_smarty_tpl->tpl_vars['jsFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footerJs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsFile']->key => $_smarty_tpl->tpl_vars['jsFile']->value){
$_smarty_tpl->tpl_vars['jsFile']->_loop = true;
?>
				<script type="text/javascript" src="js/<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>
"></script>
		<?php } ?>
	<?php }?>

	</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.7, created on 2013-05-24 15:30:13
         compiled from ".\templates\errors.tpl" */ ?>
<?php if ($_valid && !is_callable('content_519f878510da0')) {function content_519f878510da0($_smarty_tpl) {?><?php if (!empty($_smarty_tpl->tpl_vars['errors']->value)){?>
	<div class="errors" id="<?php echo $_smarty_tpl->tpl_vars['errorsAnchorName']->value;?>
">
		<span class="errors-count">Celkem chyb: <?php echo $_smarty_tpl->tpl_vars['errorsCount']->value;?>
</span><hr />
		<?php $_smarty_tpl->tpl_vars['shownMessagesCount'] = new Smarty_variable(0, null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['groupMessages'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['groupMessages']->_loop = false;
 $_smarty_tpl->tpl_vars['groupName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['groupMessages']->key => $_smarty_tpl->tpl_vars['groupMessages']->value){
$_smarty_tpl->tpl_vars['groupMessages']->_loop = true;
 $_smarty_tpl->tpl_vars['groupName']->value = $_smarty_tpl->tpl_vars['groupMessages']->key;
?>
		<?php $_smarty_tpl->tpl_vars['shownMessagesCount'] = new Smarty_variable($_smarty_tpl->tpl_vars['shownMessagesCount']->value+sizeof($_smarty_tpl->tpl_vars['groupMessages']->value), null, 0);?>
		<h4><?php echo $_smarty_tpl->tpl_vars['groupName']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['shownMessagesCount']->value;?>
 z <?php echo $_smarty_tpl->tpl_vars['errorsCount']->value;?>
):</h4>
		<ul>
			<?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['message']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groupMessages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value){
$_smarty_tpl->tpl_vars['message']->_loop = true;
?>
			<li><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
<?php }?><?php }} ?>