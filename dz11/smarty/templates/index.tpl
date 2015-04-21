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
                            {if isset($id)}
                                {html_radios name='whois' options = $data.whois selected = $adv[$id]->getwhois()}
                            {else}
                                {html_radios name='whois' options = $data.whois selected = 1 }
                            {/if}
                        </div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="{if isset($id)}{$adv[$id]->getname()}{else}{/if}" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="{if isset($id)}{$adv[$id]->getemail()}{else}{/if}" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="subscribe" value="1" {if isset($id) && $adv[$id]->getsubscribe() eq 1 } checked {/if}>Я хочу получать уведомления на Email     
                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="{if isset($id)}{$adv[$id]->getphone()}{else}{/if}" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                {if isset($id)}
                                    {html_options name='city' options = $data.select_city selected = $adv[$id]->getcity()}
                                {else}
                                    {html_options name='city' options = $data.select_city}
                                {/if}
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                {if isset($id)}
                                    {html_options name='category' options = $data.select_category selected = $adv[$id]->getcategory()}
                                {else}
                                    {html_options name='category' options = $data.select_category}
                                {/if}
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="{if isset($id)}{$adv[$id]->gettitle()}{else}{/if}" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message">{if isset($id)}{$adv[$id]->getmessage()}{else}{/if}</textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="{if isset($id)}{$adv[$id]->getprice()}{else}{/if}" /></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="{$data.button_label|default:'Отправить'}" />
                            <input type="hidden" name="id" value="{$id}">
                        </div>
                    </fieldset>
                </form>
<table border =0 >
    {foreach from = $adv item = value}
        <tr>
            <td><a href = index.php?change={$value->getid()}>{$value->gettitle()}</a></td>
            <td>{$value->getprice()}</td>
            <td>{$value->getname()}</td>
            <td><a href = index.php?del={$value->getid()}>Удалить</a></td>
        </tr>
    {/foreach}
    {$notice}
  
</table>
            
            
            </div>
{include file='footer.tpl'}

