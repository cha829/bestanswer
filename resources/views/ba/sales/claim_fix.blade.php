<?php $client_name = '得意先名がありません'; ?>
@foreach ($clients as $client)
 @if($client_id == $client->client_id)
 <?php $client_name = $client->client_name; ?>
 @endif
@endforeach
<h2><a href="/app/public/claim_fix2?client_id={{$client_id}}" target="_blank" >{{$client_name}}</a></h2>
<?php $totals= 0 ?>
@foreach ($items as $item)
 @if($item->client_id == $client_id)
  <?php $product_name = '商品名がありません'; ?>
  {{ $item->day }} ,
   @foreach ($products as $product)
   @if($item->product_id == $product->product_id)
    {{$product->product_id}}
    <?php $product_name = $product->product_name; ?>
   @endif
  @endforeach
  @if($product_name == '商品名がありません')
   {{$item->product_id}}
   <a href="/app/public/claim_fix3?product_id={{$item->product_id}}" target="_blank" >{{$product_name}}</a> ,
  @else
   {{$product_name}} ,
  @endif
   <?php $total = $item->num * $item->price ?>
   {{ $item->num }} ,
   {{ $item->price }} ,
   {{ $total }} ,
   <a href="/app/public/claim_fix4?slip_id={{$item->slip_id}}" target="_blank" >修正する</a><br>
   <?php $totals += $total ?>
 @endif
@endforeach
{{$totals}}
