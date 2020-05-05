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
@component('mail::table')
    | Produs           | Cantitate     | Pret      |
    |:-------------:   |:-----------   |:--------: |
    @foreach ($products as $item) @foreach($item as $key => $value)
    | {{ $value['name'] }}          | {{ $value['quantity'] }} buc. |       {{ $value['price'] }} Ron |
    @endforeach @endforeach
@endcomponent

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
