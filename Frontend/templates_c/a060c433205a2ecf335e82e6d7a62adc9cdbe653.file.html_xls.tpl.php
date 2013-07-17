<?php /* Smarty version Smarty-3.1.7, created on 2013-06-04 18:24:14
         compiled from "C:\Users\JT\Dropbox\Projects\universal\Base/../templates\export\html_xls.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2030451a354f24abe30-49324460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a060c433205a2ecf335e82e6d7a62adc9cdbe653' => 
    array (
      0 => 'C:\\Users\\JT\\Dropbox\\Projects\\universal\\Base/../templates\\export\\html_xls.tpl',
      1 => 1370274464,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2030451a354f24abe30-49324460',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_51a354f267778',
  'variables' => 
  array (
    'contentLanguage' => 1,
    'contentCharset' => 1,
    'headTitle' => 1,
    'descriptionContent' => 1,
    'border' => 1,
    'cellspacing' => 1,
    'cellpading' => 1,
    'data' => 1,
    'headerCell' => 1,
    'bodyRow' => 1,
    'bodyCell' => 1,
    'footerCell' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a354f267778')) {function content_51a354f267778($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">

<?php  $_config = new Smarty_Internal_Config("base.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("checks", 'local'); ?>
<?php  $_config = new Smarty_Internal_Config("export-html_xls.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("head", 'local'); ?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:x="urn:schemas-microsoft-com:office:excel"
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="<?php if (isset($_smarty_tpl->tpl_vars['contentLanguage']->value)){?><?php echo $_smarty_tpl->tpl_vars['contentLanguage']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('contentLanguage');?>
<?php }?>">
	<head>
		<meta http-equiv='Content-Language' content='<?php if (isset($_smarty_tpl->tpl_vars['contentLanguage']->value)){?><?php echo $_smarty_tpl->tpl_vars['contentLanguage']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('contentLanguage');?>
<?php }?>'></meta>
		<meta http-equiv='Content-Type' content='text/html; charset=<?php if (isset($_smarty_tpl->tpl_vars['contentCharset']->value)){?><?php echo $_smarty_tpl->tpl_vars['contentCharset']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('contentCharset');?>
<?php }?>'></meta>
		<title><?php if (isset($_smarty_tpl->tpl_vars['headTitle']->value)){?><?php echo $_smarty_tpl->tpl_vars['headTitle']->value;?>
<?php }?></title>
<?php if (isset($_smarty_tpl->tpl_vars['descriptionContent']->value)){?>
		<meta name='description' content='<?php echo $_smarty_tpl->tpl_vars['descriptionContent']->value;?>
'>
<?php }?>
	</head>
	<body>
<?php  $_config = new Smarty_Internal_Config("export-html_xls.tpl.ini", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("table", 'local'); ?>
		<table x:str border=<?php if (isset($_smarty_tpl->tpl_vars['border']->value)){?><?php echo $_smarty_tpl->tpl_vars['border']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('border');?>
<?php }?>
			cellspacing=<?php if (isset($_smarty_tpl->tpl_vars['cellspacing']->value)){?><?php echo $_smarty_tpl->tpl_vars['cellspacing']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('cellspacing');?>
<?php }?>
			cellpading=<?php if (isset($_smarty_tpl->tpl_vars['cellpading']->value)){?><?php echo $_smarty_tpl->tpl_vars['cellpading']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('cellpading');?>
<?php }?>>
<?php if ($_smarty_tpl->tpl_vars['data']->value->header){?>
			<thead>
				<tr<?php if ($_smarty_tpl->tpl_vars['data']->value->header->bgcolor){?> BGCOLOR="<?php echo $_smarty_tpl->tpl_vars['data']->value->header->bgcolor;?>
"<?php }?>>
	<?php  $_smarty_tpl->tpl_vars['headerCell'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['headerCell']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value->header; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['headerCell']->key => $_smarty_tpl->tpl_vars['headerCell']->value){
$_smarty_tpl->tpl_vars['headerCell']->_loop = true;
?><th><?php echo $_smarty_tpl->tpl_vars['headerCell']->value;?>
</th><?php } ?>
				</tr>
			</thead>
<?php }?>
			<tbody>
<?php  $_smarty_tpl->tpl_vars['bodyRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bodyRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bodyRow']->key => $_smarty_tpl->tpl_vars['bodyRow']->value){
$_smarty_tpl->tpl_vars['bodyRow']->_loop = true;
?>
				<tr<?php if ($_smarty_tpl->tpl_vars['bodyRow']->value->bgcolor){?> BGCOLOR="<?php echo $_smarty_tpl->tpl_vars['bodyRow']->value->bgcolor;?>
"<?php }?>>
	<?php  $_smarty_tpl->tpl_vars['bodyCell'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bodyCell']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bodyRow']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bodyCell']->key => $_smarty_tpl->tpl_vars['bodyCell']->value){
$_smarty_tpl->tpl_vars['bodyCell']->_loop = true;
?><td><?php echo $_smarty_tpl->tpl_vars['bodyCell']->value;?>
</td><?php } ?>
				</tr>
<?php } ?>

<?php if ($_smarty_tpl->tpl_vars['data']->value->footer){?>
				<tr />
				<tr<?php if ($_smarty_tpl->tpl_vars['data']->value->footer->bgcolor){?> BGCOLOR="<?php echo $_smarty_tpl->tpl_vars['data']->value->footer->bgcolor;?>
"<?php }?>>
	<?php  $_smarty_tpl->tpl_vars['footerCell'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['footerCell']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value->footer; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['footerCell']->key => $_smarty_tpl->tpl_vars['footerCell']->value){
$_smarty_tpl->tpl_vars['footerCell']->_loop = true;
?><td><?php echo $_smarty_tpl->tpl_vars['footerCell']->value;?>
</td><?php } ?>
				</tr>
<?php }?>
			</tbody>
		</table>
	</body>
</html>

<?php }} ?>