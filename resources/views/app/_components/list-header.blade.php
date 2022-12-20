
    @php
        echo Helpers::moduleBar(
            $route,
            true,
            (($request->has('keywords')) ? $request->input('keywords') : ''),
            ((isset($placeholder)) ? $placeholder : 'Digite aqui o(s) termo(s) de sua pesquisa...'),
            ((isset($otherFields)) ? $otherFields : '')
        );
    @endphp

    @if(isset($form_function) && isset($form_function->type) && isset($form_function->message))
        {{ Helpers::alert( $form_function->type, $form_function->message) }}
    @endif

    @if(session()->has('notifyType'))
        {{ Helpers::formAlert( session('notifyType') ) }}
    @endif
