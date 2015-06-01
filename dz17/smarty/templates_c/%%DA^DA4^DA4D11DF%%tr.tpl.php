<?php /* Smarty version 2.6.28, created on 2015-06-01 09:28:02
         compiled from tr.tpl */ ?>
<tr>
                    <td><a href = index.php?change=<?php echo $this->_tpl_vars['value']->getid(); ?>
><?php echo $this->_tpl_vars['value']->gettitle(); ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['value']->getname(); ?>
</td>
                    <td><?php echo $this->_tpl_vars['value']->getprice(); ?>
</td>

                    <td><a class="del">Удалить </a>/<a class="change" href = index.php?change=<?php echo $this->_tpl_vars['value']->getid(); ?>
> Редактировать</a></td>
                    <td style="display:none" id = '<?php echo $this->_tpl_vars['value']->getid(); ?>
' ><?php echo $this->_tpl_vars['value']->getid(); ?>
</td>
                </tr>