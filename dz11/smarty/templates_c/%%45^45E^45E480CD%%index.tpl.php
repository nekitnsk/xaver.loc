<?php /* Smarty version 2.6.28, created on 2015-04-30 07:50:15
         compiled from index.tpl */ ?>
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
                <form class="form-horizontal" method="POST" role="form">
                    
                    
                    
                </form>>
                
                
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
