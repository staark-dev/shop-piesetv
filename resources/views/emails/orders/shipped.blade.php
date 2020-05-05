@component('mail::message')
# Order Shipped

Salutare {{ $user->getfullname() }},<br />
Comanda ta a fost preluata cu succes, curand veii fii informat cu privire la statutul comenzii.

@component('mail::table')
    | Produs           | Cantitate     | Pret      |
    |:-------------:   |:-----------   |:--------: |
    @foreach ($products as $item) @foreach($item as $key => $value)
    | {{ $value['name'] }}          | {{ $value['quantity'] }} buc. |       {{ $value['price'] }} Ron |
    @endforeach @endforeach
@endcomponent

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
