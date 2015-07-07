<?php
/* @var $this AdController */

$this->breadcrumbs=array(
	'Ad',
);
?>
<h1>Все объявления</h1>



<div ng-app = "allAd">
<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th style="display:none;">id</th>
        <th>№</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Контактное лицо</th>
      </tr>
    </thead>
    <tbody>
    	
    		<tr ng-repeat="ad in ads">
    			<td style="display:none;">{{ ad.id }}</td>
    			<td>{{ $index + 1 }}</td>
    			<td>{{ ad.title }}</td>
    			<td>{{ ad.price }}</td>
    			<td>{{ ad.name }}</td>
    		</tr>
    	



    </tbody>
  </table>
</div>

