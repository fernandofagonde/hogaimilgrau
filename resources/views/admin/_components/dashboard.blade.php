
    <div id="dashboard">

        <div class="stats-grid">

            <div class="status-grid-col">
                <div class="card card-payable">
                    <strong>@php echo Html::icon('icon-users'); @endphp Clientes</strong>
                    <span>@php echo $stats->totalClients; @endphp</span>
                </div>
            </div>

            <div class="status-grid-col">
                <div class="card card-receivable">
                    <strong>@php echo Html::icon('icon-users'); @endphp Ativos</strong>
                    <span>@php echo $stats->activeClients; @endphp</span>
                </div>
            </div>

            <div class="status-grid-col">
                <div class="card card-provided">
                    <strong>@php echo Html::icon('icon-users'); @endphp Logados</strong>
                    <span>@php echo $stats->loggedClients; @endphp</span>
                </div>
            </div>

        </div>

    </div>
