<form action="/app/public/output_export" method="get">
    {{ csrf_field() }}
<h2>{{ $year }}年{{$mouth}}月　得意先別売上月報</h2>
@foreach ($clients as $client)
<?php $totals= 0 ?>
<?php $tax_total= 0 ?>
<?php $taxs= 0 ; ?>
    @foreach ($items as $item)
        <?php $client_id = $client->client_id; ?>
        <?php $client_name = $client->client_name; ?>
        @if($client_id == $item->client_id)
            <?php $total = $item->num * $item->price ?>
            <?php $totals += $total ?>
            @if($item->tax_id == 1)
                <?php $tax = $item->num * $item->price ?>
                <?php $tax_total += $tax ?>
            @endif
        @endif
        <?php $taxs = $tax_total * 0.08 ?>
        <?php $tax_totals = $totals + $taxs ?>
    @endforeach
    {{$client_name}} ,
    {{$totals}} ,
    {{$taxs}} ,
    {{$tax_totals}}<br>
@endforeach
<button type="sumbit" name="btn_output_export">csv出力</button>
</from>

