@component('mail::message')
# Order Shipped

Comanda noua plasata de catre {{ $user->getfullname() }}, {{ \Carbon\Carbon::now() }}<br />
@component('mail::panel')
# Adresa livrare
Nume: <b>Nume User</b> | Prenume: <b>Prenume User</b><br>
Str. Randunelelor, Bl. A2, Sc. 3, Ap. 18. Jud. Constanta, Navodari<br />
Cod Postal: 568757 <br>
Email: emnail@gmail.com<br>
Telefon: 072********
@endcomponent

# Detalii privind comanda si produsele.
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
# Order Informations
Order Number: #{{ str_pad($order->id, 8, "0", STR_PAD_LEFT) }} <br>
Order Status: {{ ($order->status == true) ? 'Procesata' : 'Anulata' }}
<hr>
Sub Total: {{ $order->total_price }} RON<br />
Transport: {{ $order->tax }} RON<br />
Total:  {{ $order->total_price + $order->tax }} RON<br />
@endcomponent

@component('mail::button', ['url' => route('admin.orders.update', ['order' => $order->id]), 'color' => 'success'])
View Order Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
