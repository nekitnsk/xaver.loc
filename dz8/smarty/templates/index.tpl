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
                            {html_radios name='whois' options = $whois selected = $whois_ch|default:1}
                        </div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="{$whois_ch}" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="{$email_ch}" /></dd>
                            <div id="radio">
                                {html_checkboxes name='subscribe' options = $subscribe selected = $subscribe_ch|default:0}
                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="{$phone_ch}" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                {html_options name = 'city' options = $select_city selected = $selected_city}
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                {html_options name = 'category' options = $select_category selected = $selected_category}
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="{$title_ch}" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message">{$message_ch}</textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="{$price_ch}" /></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="{$send_ch|default:'Отправить'}" />
                            <input type="hidden" name="id" value="{$id}">
                        </div>
                    </fieldset>
                </form>
<table border =0 >
    {foreach from=$notice key=key item=value}
        <tr>
            <td><a href = dz8.php?change={$key}>{$value.title}</a></td>
            <td>{$value.price}</td>
            <td>{$value.name}</td>
            <td><a href = dz8.php?del={$key}>Удалить</a></td>
        </tr>
    {/foreach}
</table>
            
            
            </div>
{include file='footer.tpl'}

