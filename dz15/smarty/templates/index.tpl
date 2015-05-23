{include file='header.tpl'}


    <div class="jumbotron">
        <h2>Добавить объявление</h2>
        
        <form class="form-horizontal" method="POST" role="form">

            <div class="form-group">
                {foreach from = $data.whois key = "key" item =  "value"}
                    <input name="whois" type="radio" value="{$key}" {if isset($id) && $adv[$id]->getwhois() eq $key }checked{/if}>{$value}
                {/foreach}
            </div>

            <div class="form-group">
                <label for = "name" class="col-sm-4 control-label">Ваше имя</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" value="{if isset($id)}{$adv[$id]->getname()}{else}{/if}" />
                </div>
            </div>

            <div class="form-group">
                <label for = "email" class="col-sm-4 control-label">Ваш email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" class="form-control" value="{if isset($id)}{$adv[$id]->getemail()}{else}{/if}" />
                </div>
            </div>

            <div class="form-group">
                <input type="checkbox" name="subscribe" value="1" {if isset($id) && $adv[$id]->getsubscribe() eq 1 } checked {/if}>Я хочу получать уведомления на Email
            </div>

            <div class="form-group">
                <label for = "phone" class="col-sm-4 control-label">Номер телефона</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" value="{if isset($id)}{$adv[$id]->getphone()}{else}{/if}" />
                </div>

            </div>

            <div class="form-group">
                <label for = "city" class="col-sm-4 control-label">Город</label>
                <div class="col-sm-6">
                    <select class="form-control" name="city">
                        <option disabled selected>Выберите город</option>
                        {foreach from = $data.select_city key = "key" item =  "value"}
                            <option value="{$key}" {if isset($id) && $adv[$id]->getcity() eq $key } selected {/if}> {$value} </option>
                        {/foreach}
                    </select>
                </div>

            </div>
            <div class="form-group">
                <label for = "category" class="col-sm-4 control-label">Категория объявления</label>
                <div class="col-sm-6">
                    <select class="form-control" name="category">
                        <option disabled selected>Выберите категорию</option>
                        {foreach from = $data.select_category key = "key" item =  "value"}
                            <option value="{$key}" {if isset($id) && $adv[$id]->getcategory() eq $key } selected {/if}> {$value} </option>
                        {/foreach}
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for = "title" class="col-sm-4 control-label">Название объявления</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" value="{if isset($id)}{$adv[$id]->gettitle()}{else}{/if}" />
                </div>
            </div>

            <div class="form-group">
                <label for = "message" class="col-sm-4 control-label">Описание объявления</label>
                <div class="col-sm-6">
                    <textarea cols="" rows="5" class="form-control" name="message">{if isset($id)}{$adv[$id]->getmessage()}{else}{/if}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for = "price" class="col-sm-4 control-label">Цена, руб.</label>
                <div class="col-sm-4">
                    <input type="text" name="price" class="form-control" value="{if isset($id)}{$adv[$id]->getprice()}{else}{/if}" />
                </div>
            </div>
                
            <div class="form-group">
                
                
                    <input type="submit" name="send" class="btn btn-info" value="Отправить" />
                    <input type="hidden" name="id" value="{$id}">
                
            </div>




        </form>
    </div>
                
 <h2>Все объявления</h2>
    <div class="table-responsive">
        <table class="table table-striped">
           
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Кто добавил</th>
                    <th>Цена</th>
                    
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                {foreach from = $adv item = value}
                    <tr>
                        <td><a href = index.php?change={$value->getid()}>{$value->gettitle()}</a></td>
                        <td>{$value->getname()}</td>
                        <td>{$value->getprice()}</td>
                        
                        <td><a class="del">Удалить </a>/<a class="change" href = index.php?change={$value->getid()}> Редактировать</a></td>
                        <td style="display:none">{$value->getid()}</td>
                    </tr>
                {/foreach}

            </tbody>
        </table>
    </div>

    







    {*<form  id = "ad"  method="POST">
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
    </form>*}




    {include file='footer.tpl'}

