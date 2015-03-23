{include file='header.tpl'}

        <div id="maket">
            <div id="header">
                <h1> HLAMA.NET - лучшая барахолка рунета</h1>
            </div>
            <div id="left">Левая колонка</div>
            <div id="content">
                <form  id = "notice"  method="POST">
                    <fieldset>
                        <div id="radio">
                            {html_radios name='whois' options = $data.whois selected = $notice.whois|default:1}
                        </div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="{$notice.name|default:''}" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="{$notice.email|default:''}" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="subscribe" value="1" {if $notice.subscribe eq 1 } checked {/if}>Я хочу получать уведомления на Email     
                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="{$notice.phone|default:''}" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                {html_options name = 'city' options = $data.select_city selected = $notice.city}
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                {html_options name = 'category' options = $data.select_category selected = $notice.category}
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="{$notice.title|default:''}" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message">{$notice.message|default:''}</textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="{$notice.price|default:''}" /></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="{$data.button_label|default:'Отправить'}" />
                            <input type="hidden" name="id" value="{$id}">
                        </div>
                    </fieldset>
                </form>
<table border =0 >
    {foreach from=$adv key=key item=value}
        <tr>
            <td><a href = index.php?change={$value.id}>{$value.title}</a></td>
            <td>{$value.price}</td>
            <td>{$value.name}</td>
            <td><a href = index.php?del={$value.id}>Удалить</a></td>
        </tr>
    {/foreach}
  
</table>
            
            
            </div>
{include file='footer.tpl'}

