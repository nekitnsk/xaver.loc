<?php /* Smarty version 2.6.28, created on 2015-04-30 11:28:42
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


    <div class="jumbotron">
        <h2>Добавить объявление</h2>
        
        <form class="form-horizontal" method="POST" role="form">

            <div class="form-group">
                <?php $_from = $this->_tpl_vars['data']['whois']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                    <input name="whois" type="radio" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (isset ( $this->_tpl_vars['id'] ) && $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getwhois() == $this->_tpl_vars['key']): ?>checked<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>

                <?php endforeach; endif; unset($_from); ?>
            </div>

            <div class="form-group">
                <label for = "name" class="col-sm-4 control-label">Ваше имя</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getname(); ?>
<?php else: ?><?php endif; ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for = "email" class="col-sm-4 control-label">Ваш email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" class="form-control" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getemail(); ?>
<?php else: ?><?php endif; ?>" />
                </div>
            </div>

            <div class="form-group">
                <input type="checkbox" name="subscribe" value="1" <?php if (isset ( $this->_tpl_vars['id'] ) && $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getsubscribe() == 1): ?> checked <?php endif; ?>>Я хочу получать уведомления на Email
            </div>

            <div class="form-group">
                <label for = "phone" class="col-sm-4 control-label">Номер телефона</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getphone(); ?>
<?php else: ?><?php endif; ?>" />
                </div>

            </div>

            <div class="form-group">
                <label for = "city" class="col-sm-4 control-label">Город</label>
                <div class="col-sm-6">
                    <select class="form-control" name="city">
                        <option disabled selected>Выберите город</option>
                        <?php $_from = $this->_tpl_vars['data']['select_city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (isset ( $this->_tpl_vars['id'] ) && $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getcity() == $this->_tpl_vars['key']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['value']; ?>
 </option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <label for = "category" class="col-sm-4 control-label">Категория объявления</label>
                <div class="col-sm-6">
                    <select class="form-control" name="category">
                        <option disabled selected>Выберите категорию</option>
                        <?php $_from = $this->_tpl_vars['data']['select_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (isset ( $this->_tpl_vars['id'] ) && $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getcategory() == $this->_tpl_vars['key']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['value']; ?>
 </option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for = "title" class="col-sm-4 control-label">Название объявления</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->gettitle(); ?>
<?php else: ?><?php endif; ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for = "message" class="col-sm-4 control-label">Описание объявления</label>
                <div class="col-sm-6">
                    <textarea cols="" rows="5" class="form-control" name="message"><?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getmessage(); ?>
<?php else: ?><?php endif; ?></textarea>
                </div>
            </div>
                
            <div class="form-group">
                <label for = "price" class="col-sm-4 control-label">Цена, руб.</label>
                <div class="col-sm-4">
                    <input type="text" name="price" class="form-control" value="<?php if (isset ( $this->_tpl_vars['id'] )): ?><?php echo $this->_tpl_vars['adv'][$this->_tpl_vars['id']]->getprice(); ?>
<?php else: ?><?php endif; ?>" />
                </div>
            </div>




        </form>
    </div>
                
 <h2>Все объявления</h2>
    <div class="table-responsive">
        <table class="table table-striped">
           
            <thead>
                <tr>
                    <th>№ id</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>

    







    



    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
