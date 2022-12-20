
<ul class="list">

    <li class="list-header">
        <div class="w-10 align-center">#</div>
        <div class="w-25">Título / Descrição</div>
        <div class="w-15 align-center">Beneficiário</div>
        <div class="w-10 align-center">Data Pgto.</div>
        <div class="w-10 align-center">Valor</div>
        <div class="w-15 align-center">Status</div>
        <div class="w-15 align-center">Opções</div>
    </li>

    @foreach($items as $index => $item)

        <li class="list-item">
            <div data-label="#" class="w-10 align-center">{{ $item->id }}</div>
            <div data-label="Título" class="w-25 no-flex">{{ $item->title }}@php if($item->description != '') { echo '<br><small>'. $item->description .'</small>'; }@endphp</div>
            <div data-label="Beneficiário" class="w-15 align-center">{{ $item->people_name ?? '-' }}</div>
            <div data-label="Data Pgto." class="w-10 align-center">{{ Main::date($item->payday) }}</div>
            <div data-label="Valor" class="w-10 align-center">{{ Main::money($item->amount) }}</div>
            <div data-label="Status" class="w-15 align-center">@switch($item->status)

                @case('OPEN')
                    <div class="status-badge status-open">ABERTA</div>
                    @break

                @case('DELAYED')
                    <div class="status-badge status-delayed">ATRASADA</div>
                    @break

                @case('PAID')
                    <div class="status-badge status-paid">PAGA</div>
                    @break

                @case('CANCELED')
                    <div class="status-badge status-canceled">CANCELADA</div>
                    @break

            @endswitch</div>
            <div data-label="Opções" class="w-15 list-buttons">
                <button type="button" class="button button-info button-list-edit" data-module="{{ $module }}" data-id="{{ $item->id }}"><i class="icon-edit"></i><span>Editar</span></button>
                <button type="button" class="button button-danger button-list-del" id="delete-button-{{ md5($item->id) }}" data-module="{{ $module }}" data-id="{{ $item->id }}"><i class="icon-trash"></i><span>Apagar</span></button>
            </div>
        </li>

    @endforeach

</ul>

@if(!isset($dashboard))

    <form id="delete-form" action="" method="post">
        @method('DELETE')
        @csrf
    </form>

@endif

@if(!isset($dashboard) && $items->lastPage() > 1)

    <div class="pagination">

        @for($i=0; $i<$items->total(); $i++)

            @php  $page = $i+1; @endphp

            <div class="pagination-link @if($items->currentPage() == $page) active @endif">
                <a href="{{ route($route . ((isset($request)) ? '.search' : '.index')) }}?page={{ $page }}@if(isset($request))&keywords={{ $request->input('keywords') }} @endif" title="Página {{ $page }}">{{ $page }}</a>
            </div>

        @endfor

    </div>

@endif
