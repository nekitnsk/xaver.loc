<tr>
                    <td><a href = index.php?change={$value->getid()}>{$value->gettitle()}</a></td>
                    <td>{$value->getname()}</td>
                    <td>{$value->getprice()}</td>

                    <td><a class="del">Удалить </a>/<a class="change" href = index.php?change={$value->getid()}> Редактировать</a></td>
                    <td style="display:none" id = '{$value->getid()}' >{$value->getid()}</td>
                </tr>