<?php /* Smarty version 2.6.28, created on 2015-02-12 14:03:51
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'index.tpl', 12, false),array('function', 'html_checkboxes', 'index.tpl', 20, false),array('function', 'html_options', 'index.tpl', 26, false),array('modifier', 'default', 'index.tpl', 12, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <div id="maket">
            <div id="header">
                <h1> HLAMA.NET - лучшая барахолка рунета</h1>
            </div>
            <div id="left">Левая колонка</div>
            <div id="content">
                <form  id = "notice"  method="POST">
                    <fieldset>
                        <div id="radio">
                            <?php echo smarty_function_html_radios(array('name' => 'whois','options' => $this->_tpl_vars['data']['whois'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['whois'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))), $this);?>

                        </div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['name'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['email'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></dd>
                            <div id="radio">
                                <?php echo smarty_function_html_checkboxes(array('name' => 'subscribe','options' => $this->_tpl_vars['data']['subscribe'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['subscribe'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0))), $this);?>

                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?php echo smarty_function_html_options(array('name' => 'city','options' => $this->_tpl_vars['data']['select_city'],'selected' => $this->_tpl_vars['notice'][$this->_tpl_vars['id']]['city']), $this);?>

                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['data']['select_category'],'selected' => $this->_tpl_vars['notice'][$this->_tpl_vars['id']]['category']), $this);?>

                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['title'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message"><?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['message'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['notice'][$this->_tpl_vars['id']]['price'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['data']['button_label'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Отправить') : smarty_modifier_default($_tmp, 'Отправить')); ?>
" />
                            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
                        </div>
                    </fieldset>
                </form>
<table border =0 >
    <?php $_from = $this->_tpl_vars['notice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
        <tr>
            <td><a href = dz8.php?change=<?php echo $this->_tpl_vars['key']; ?>
><?php echo $this->_tpl_vars['value']['title']; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['value']['price']; ?>
</td>
            <td><?php echo $this->_tpl_vars['value']['name']; ?>
</td>
            <td><a href = dz8.php?del=<?php echo $this->_tpl_vars['key']; ?>
>Удалить</a></td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
            
            
            </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
