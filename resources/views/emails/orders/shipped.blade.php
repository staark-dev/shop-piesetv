@component('mail::message')
# Order Shipped

Salutare {{ $user->getfullname() }},<br />
Comanda ta a fost preluata cu succes, curand veii fii informat cu privire la statutul comenzii.

@component('mail::table')
    | Produs                        | Cantitate               | Pret                     |
    | ----------------------------- |:-----------------------:| ------------------------:|
    @foreach ($products as $item) @foreach($item as $key => $value)
    {{ $value['name'] }}            {{ $value['quantity'] }} buc.        {{ $value['price'] }} Ron
    @endforeach @endforeach
@endcomponent

Sub Total: 140 ron<br />
Transport: 25 ron <br />
Total:  165 ron<br />

@component('mail::button', ['url' => route('user.orders') . '/' . $order->hash, 'color' => 'success'])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
