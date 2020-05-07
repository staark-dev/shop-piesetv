@component('mail::message')
# Order Shipped

Salutare {{ $user->getfullname() }},<br />
Comanda ta a fost preluata cu succes, curand veii fii informat cu privire la statutul comenzii.

<table style="width: 100%;display: table;border-spacing: unset;">
    <thead>
        <tr>
            <th style="width: auto;padding: 5px 18px;margin: 0 5px;font-size: 18px;color: #fff;line-height: 1.4;background-color: #6c7ae0;">#</th>
            <th style="width: auto;padding: 5px 18px;margin: 0 5px;font-size: 18px;color: #fff;line-height: 1.4;background-color: #6c7ae0;">Produs</th>
            <th style="width: auto;padding: 5px 18px;margin: 0 5px;font-size: 18px;color: #fff;line-height: 1.4;background-color: #6c7ae0;">Cantitate</th>
            <th style="width: auto;padding: 5px 18px;margin: 0 5px;font-size: 18px;color: #fff;line-height: 1.4;background-color: #6c7ae0;">SubTotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item) @foreach($item as $key => $value)
        <tr>
            <td style="box-sizing: border-box;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';position: relative;font-size: 15px;color: gray;line-height: 1.4;width: auto;padding: 10px 18px;margin: 0 5px;display: table-cell;border-bottom: 1px solid #00000036;text-align: center;">#{{ str_pad($order->id, 8, "0", STR_PAD_LEFT) }}</td>
            <td style="box-sizing: border-box;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';position: relative;font-size: 15px;color: gray;line-height: 1.4;width: auto;padding: 10px 18px;margin: 0 5px;display: table-cell;border-bottom: 1px solid #00000036;text-align: center;">{{ $value['name'] }}</td>
            <td style="box-sizing: border-box;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';position: relative;font-size: 15px;color: gray;line-height: 1.4;width: auto;padding: 10px 18px;margin: 0 5px;display: table-cell;border-bottom: 1px solid #00000036;text-align: center;">{{ $value['quantity'] }} buc. </td>
            <td style="box-sizing: border-box;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';position: relative;font-size: 15px;color: gray;line-height: 1.4;width: auto;padding: 10px 18px;margin: 0 5px;display: table-cell;border-bottom: 1px solid #00000036;text-align: center;">{{ $value['price'] * $value['quantity'] }} Ron</td>
        @endforeach @endforeach
    </tbody>
</table>

@component('mail::panel')
# Informatii Comanda
Numar: #{{ str_pad($order->id, 8, "0", STR_PAD_LEFT) }} <br>
Hash: {{ $order->hash }}
<hr>
Sub Total: {{ $order->total_price }} ron<br />
Transport: {{ $order->tax }} ron<br />
Total:  {{ $order->total_price + $order->tax }} ron<br />
@endcomponent

@component('mail::button', ['url' => route('user.orders') . '/' . $order->hash, 'color' => 'success'])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
