
    @php

    // Basic Route Name
    $route = 'admin.blog.categories';

    // Form Field Data
    $id = (isset($category)) ? $category->id : '';
    $published = (isset($category)) ? $category->published : old('published');
    $name = (isset($category)) ? $category->name : old('title');
    $description = (isset($category)) ? $category->description : old('content');

    // Form Params
    $params = ($id > 0) ? [ 'id', $id ] : [];

    // Open Form
    echo Html::formOpen(route($route . '.save', $params), $form_function);

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

        /

        /*
        * Name
        */

        echo Html::formField(
            'input',
            [
                'label' => 'Nome',
                'name' => 'name',
                'value' => $name,
                'class' => 'required'
            ]
        );

        /*
        * Name Errors
        */

        if($errors->has('name')) {

            echo Helpers::formError($errors->first('name'));

        }

        /*
        * Description
        */

        echo Html::formField(
            'textarea',
            [
                'label' => 'Descrição',
                'name' => 'description',
                'value' => $description,
                'editor' => 'standard',
                'class' => 'required'
            ]
        );

        /*
        * Description Errors
        */

        if($errors->has('description')) {

            echo Helpers::formError($errors->first('description'));

        }

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
