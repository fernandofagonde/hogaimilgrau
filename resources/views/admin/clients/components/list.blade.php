
<ul class="list">

    <li class="list-header">
        <div class="w-10 align-center">#</div>
        <div class="w-30">Nome</div>
        <div class="w-30 align-center">E-mail</div>
        <div class="w-15 align-center">Últ. Login</div>
        <div class="w-15 align-center">Opções</div>
    </li>

    @foreach($items as $index => $item)

        <li class="list-item">
            <div data-label="#" class="w-10 align-center">{{ $item->id }}</div>
            <div data-label="Nome" class="w-30">{{ $item->name }}</div>
            <div data-label="E-mail" class="w-30 align-center">{{ $item->email }}</div>
            <div data-label="Últ. Login" class="w-15 align-center">{{ Main::datetime($item->last_login, 'string') }}</div>
            <div data-label="Opções" class="w-15 list-buttons">
                <button type="button" class="button button-info button-list-edit" data-module="{{ $module }}" data-id="{{ $item->id }}"><i class="icon-edit"></i><span>Editar</span></button>
                <button type="button" class="button button-danger button-list-del" id="delete-button-{{ md5($item->id) }}" data-module="{{ $module }}" data-id="{{ $item->id }}"><i class="icon-trash"></i><span>Apagar</span></button>
            </div>
        </li>

    @endforeach

</ul>

<form id="delete-form" action="" method="post">
    @method('DELETE')
    @csrf
</form>

@if($items->lastPage() > 1)

    <div class="pagination">

        @for($i=0; $i<$items->total(); $i++)

            @php  $page = $i+1; @endphp

            <div class="pagination-link @if($items->currentPage() == $page) active @endif">
                <a href="{{ route($route . ((isset($request)) ? '.search' : '.index')) }}?page={{ $page }}@if(isset($request))&keywords={{ $request->input('keywords') }} @endif" title="Página {{ $page }}">{{ $page }}</a>
            </div>

        @endfor

    </div>

@endif
