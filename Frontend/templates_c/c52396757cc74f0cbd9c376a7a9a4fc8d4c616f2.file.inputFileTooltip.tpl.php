<?php /* Smarty version Smarty-3.1.7, created on 2013-05-20 20:59:47
         compiled from ".\templates\inputFileTooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19993519a8ec3029426-48427616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c52396757cc74f0cbd9c376a7a9a4fc8d4c616f2' => 
    array (
      0 => '.\\templates\\inputFileTooltip.tpl',
      1 => 1365683922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19993519a8ec3029426-48427616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'columnsPurpose' => 0,
    'purpose' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_519a8ec30d185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_519a8ec30d185')) {function content_519a8ec30d185($_smarty_tpl) {?><div id="columnsContentSet">
	<h4>Vyžadovaná posloupnost sloupců</h4>
	<ol>
<?php  $_smarty_tpl->tpl_vars['purpose'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['purpose']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columnsPurpose']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['purpose']->key => $_smarty_tpl->tpl_vars['purpose']->value){
$_smarty_tpl->tpl_vars['purpose']->_loop = true;
?>
		<li id="<?php echo key($_smarty_tpl->tpl_vars['purpose']->value);?>
"><span class="possibility-name"><?php echo current($_smarty_tpl->tpl_vars['purpose']->value);?>
</span></li>
<?php } ?>
	</ol>
</div><?php }} ?>