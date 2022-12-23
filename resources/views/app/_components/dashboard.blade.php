
    <div id="dashboard">

        <div class="stats-grid">


            <div class="status-grid-col">
                <div class="card">
                    <strong>@php echo Html::icon('icon-minus-square'); @endphp Próx. Contas à Pagar</strong>
                    <span>{{ $stats['payable'] }}</span>
                </div>
            </div>

            <div class="status-grid-col">
                <div class="card">
                    <strong>@php echo Html::icon('icon-plus-square'); @endphp Próx. Contas à Receber</strong>
                    <span>{{ $stats['receivable'] }}</span>
                </div>
            </div>

            <div class="status-grid-col col-people">
                <div class="card">
                    <strong>@php echo Html::icon('icon-users'); @endphp Pessoas</strong>
                    <span>{{ $stats['people'] }}</span>
                </div>
            </div>

        </div>

        <div class="stats-grid">

            <div class="status-grid-col">
                <div class="card">
                    <strong>@php echo Html::icon('icon-minus-square'); @endphp Total à Pagar</strong>
                    <span class="color-danger">@php echo ($stats['payableProvided'] > 0) ? Main::money($stats['payableProvided']) : 'R$ 0,00'; @endphp</span>
                </div>
            </div>

            <div class="status-grid-col">
                <div class="card">
                    <strong>@php echo Html::icon('icon-plus-square'); @endphp Total à Receber</strong>
                    <span>@php echo ($stats['receivableProvided'] > 0) ? Main::money($stats['receivableProvided']) : 'R$ 0,00'; @endphp</span>
                </div>
            </div>

            <div class="status-grid-col">
                <div class="card">
                    <strong>@php echo Html::icon('icon-filter'); @endphp Saldo Previsto</strong>
                    <span class="@php echo ($stats['totalProvided'] > 0) ? 'color-info' : (($stats['totalProvided'] < 0) ? 'color-danger' : ''); @endphp">@php
                        echo ($stats['totalProvided'] > 0) ? Main::money($stats['totalProvided']) : (($stats['totalProvided'] == 0) ? 'R$ 0,00' : '-'. Main::money(abs($stats['totalProvided'])));
                    @endphp</span>
                </div>
            </div>

        </div>

        <div class="card">

            <div class="card-title">@php echo Html::icon('icon-calendar'); @endphp Próximas Contas à Pagar</div>

            @if(count($payable) > 0)

                @component('app.payable_bills.components.list', [
                    'module' => 'payable-bills',
                    'route' => 'app.payable-bills',
                    'items' => $payable,
                    'dashboard' => true
                ])
                @endcomponent

            @else

                Nenhuma conta agendada para os próximos dias

            @endif

        </div>

        <div class="card">

            <div class="card-title">@php echo Html::icon('icon-calendar'); @endphp Próximas Contas à Receber</div>

            @if(count($receivable) > 0)

                @component('app.receivable_bills.components.list', [
                    'module' => 'receivable-bills',
                    'route' => 'app.receivable-bills',
                    'items' => $receivable,
                    'dashboard' => true
                ])
                @endcomponent

            @else

                Nenhuma conta agendada para os próximos dias

            @endif

        </div>

        <form id="delete-form" action="" method="post">
            @method('DELETE')
            @csrf
        </form>

    </div>
