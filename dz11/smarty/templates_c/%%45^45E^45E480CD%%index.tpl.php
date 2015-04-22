<?php /* Smarty version 2.6.28, created on 2015-04-22 16:56:31
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'index.tpl', 13, false),array('function', 'html_options', 'index.tpl', 31, false),array('modifier', 'default', 'index.tpl', 53, false),)), $this); ?>
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
                <form  id = "ad"  method="POST">
                    <fieldset>
                        <div id="radio">
                            <?php if (isset ( $this->_tpl_vars['id'] )): ?>
                                <?php echo smarty_function_html_radios(array('name' => 'whois','options' => $this->_tpl_vars['data']['whois'],'selected' => $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getwhois()), $this);?>

                            <?php else: ?>
                                <?php echo smarty_function_html_radios(array('name' => 'whois','options' => $this->_tpl_vars['data']['whois'],'selected' => 1), $this);?>

                            <?php endif; ?>
                        </div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getname(); ?>
<?php else: ?><?php endif; ?>" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getemail(); ?>
<?php else: ?><?php endif; ?>" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="subscribe" value="1" <?php if (isset ( $this->_tpl_vars['id'] ) && $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getsubscribe() == 1): ?> checked <?php endif; ?>>Я хочу получать уведомления на Email     
                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getphone(); ?>
<?php else: ?><?php endif; ?>" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?php if (isset ( $this->_tpl_vars['id'] )): ?>
                                    <?php echo smarty_function_html_options(array('name' => 'city','options' => $this->_tpl_vars['data']['select_city'],'selected' => $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getcity()), $this);?>

                                <?php else: ?>
                                    <?php echo smarty_function_html_options(array('name' => 'city','options' => $this->_tpl_vars['data']['select_city']), $this);?>

                                <?php endif; ?>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?php if (isset ( $this->_tpl_vars['id'] )): ?>
                                    <?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['data']['select_category'],'selected' => $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getcategory()), $this);?>

                                <?php else: ?>
                                    <?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['data']['select_category']), $this);?>

                                <?php endif; ?>
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->gettitle(); ?>
<?php else: ?><?php endif; ?>" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message"><?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getmessage(); ?>
<?php else: ?><?php endif; ?></textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getprice(); ?>
<?php else: ?><?php endif; ?>" /></textarea>
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
    <?php $_from = $this->_tpl_vars['adv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
        <tr>
            <td><a href = index.php?change=<?php echo $this->_tpl_vars['value']->getid(); ?>
><?php echo $this->_tpl_vars['value']->gettitle(); ?>
</a></td>
            <td><?php echo $this->_tpl_vars['value']->getprice(); ?>
</td>
            <td><?php echo $this->_tpl_vars['value']->getname(); ?>
</td>
            <td><a href = index.php?del=<?php echo $this->_tpl_vars['value']->getid(); ?>
>Удалить</a></td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
    <?php echo $this->_tpl_vars['ad']; ?>

  
</table>
            
            
            </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
