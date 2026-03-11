<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nùdutin - Facture</title>
    </head>
    <body>
        <style>
            h4 {
                margin: 0;
            }
            .w-full {
                width: 100%;
            }
            .w-half {
                width: 50%;
            }
            .margin-top {
                margin-top: 1.25rem;
            }
            .footer {
                font-size: 0.875rem;
                padding: 1rem;
                background-color: rgb(241 245 249);
            }
            table {
                width: 100%;
                border-spacing: 0;
            }
            table.products {
                font-size: 0.875rem;
            }
            table.products tr {
                background-color: rgb(96 165 250);
            }
            table.products th {
                color: #ffffff;
                padding: 0.5rem;
            }
            table tr.items {
                background-color: rgb(241 245 249);
                text-align: center;
            }
            table tr.items td {
                padding: 0.5rem;
            }
            .total {
                text-align: right;
                margin-top: 1rem;
                font-size: 0.875rem;
            }

        </style>
        <table class="w-full">
            <tr>
                <td class="w-half">
                </td>
                <td class="w-half">
                    <h2>Facture n° CMD000{{ $order->id }}</h2>
                </td>
            </tr>
        </table>

        <div class="margin-top">
            <table class="w-full">
                <tr>
                    <td class="w-half">
                        <div><h4>Société:</h4></div>
                        <div>Nùdutin App</div>
                        <div>Cotonou, Bénin</div>
                    </td>
                    <td class="w-half">
                        <div><h4>Client:</h4></div>
                        <div>Nom:{{ $order->name }}</div>
                        <div>Contact: {{ $order->adresse }}/{{ $order->phone }}</div>
                    </td>
                </tr>
                <tr>
                    <td class="w-half">
                        <div>Restaurant : {{ $order->restaurant->name }}</div>
                        <div>Email : {{ $order->restaurant->email }}</div>
                    </td>
                </tr>
            </table>
            <br>
            <br>
        </div>

        <div class="margin-top">
            <table class="products">
                <tr>
                    <th>Plat</th>
                    <th>Prix</th>
                    <th>Qte</th>
                </tr>
                @foreach ($order_plats as $plat)
                    <tr class="items">
                        <td>{{ $plat['0'] }}</td>
                        <td>{{ $plat['2'] }}</td>
                        <td>{{ $plat['3'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="total">
            Total: {{ $order->montant_total }} fcfa
        </div>

        <div class="footer margin-top">
            <div>Merci pour vôtre commande</div>
            <div>Nùdutin App le, {{ $now }}.</div>
        </div>
    </body>
</html>
