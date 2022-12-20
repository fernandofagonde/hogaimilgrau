
    @php

    // Basic Route Name
    $route = 'blog-posts';

    // Form Field Data
    $id = (isset($publicacao)) ? $publicacao->id : '';
    $published = (isset($publicacao)) ? $publicacao->published : old('published');
    $category = (isset($publicacao)) ? $publicacao->category_id : old('category');
    $title = (isset($publicacao)) ? $publicacao->title : old('title');
    $content = (isset($publicacao)) ? $publicacao->content : old('content');
    $image = (isset($publicacao)) ? '' : old('image');

    // Form Params
    $params = ($id > 0) ? [ 'id', $id ] : [];

    // Form Route
    $route_verb = $form_function == 'add' ? 'store' : 'update';

    // Open Form
    echo Html::formOpen(route($route . '.' . $route_verb, $params), $form_function);

    @endphp

    @csrf

    @php

        // Published

        $Items = [
            [
                'label' => 'Sim',
                'value' => 'Y',
                'selected' => ($published == 'Y')
            ],
            [
                'label' => 'Não',
                'value' => 'N',
                'selected' => ($published == 'N')
            ]
        ];


        echo Html::formField(
            'select',
            [
                'label' => 'Publicada?',
                'name' => 'published',
                'class' => 'required',
                'items' => $Items
            ]
        );

        unset($Items);

        // Published Errors

        if($errors->has('published')) {

            echo Helpers::formError($errors->first('published'));

        }

        // Categories

        $Items = [];

        foreach($categories as $_category) {

            $Items[] = [
                'label' => $_category->name,
                'value' => $_category->id,
                'selected' => ($category == $_category->id)
            ];

        }

        echo Html::formField(
            'select',
            [
                'label' => 'Categoria',
                'name' => 'category',
                'class' => 'required',
                'items' => $Items
            ]
        );

        unset($Items);

        /*
        * Categories Errors
        */

        if($errors->has('category')) {

            echo Helpers::formError($errors->first('category'));

        }

        /*
        * Title
        */

        echo Html::formField(
            'input',
            [
                'label' => 'Título',
                'name' => 'title',
                'value' => $title,
                'class' => 'required'
            ]
        );

        /*
        * Title Errors
        */

        if($errors->has('title')) {

            echo Helpers::formError($errors->first('title'));

        }

        /*
        * Content
        */

        echo Html::formField(
            'textarea',
            [
                'label' => 'Conteúdo',
                'name' => 'content',
                'value' => $content,
                'editor' => 'standard',
                'class' => 'required'
            ]
        );

        /*
        * Content Errors
        */

        if($errors->has('content')) {

            echo Helpers::formError($errors->first('content'));

        }

        /*
        * Uploader
        */

        echo Html::uploadField([
            'label' => 'Imagens',
            'name' => 'images',
            'route' => 'publicacoes',
            'main' => true,
            'sortable' => true,
            'subtitled' => true,
            'limit-files' => 30,
            'limit-size' => 10,
            'crop' => true,
        ]);

        /*
        * Buttons
        */

        echo Html::formButtons($route);

        /*
        * Close Form
        */
        echo Html::formClose();

    @endphp

</form>
