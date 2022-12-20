@inject('loginController', 'App\Http\Controllers\Admin\LoginController')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title'){{ env('ADM_NAME') }}</title>
    <link rel="stylesheet" href="/assets/css/admin/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/assets/css/admin/quill.snow.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body>

    @include('admin.templates.includes.header')

    @include('admin.templates.includes.sidebar')

    <section class="main-section">

        <nav class="navbar">

            <i class="icon-menu toggle-menu"></i>

            <div>@yield('title')</div>

        </nav>

        <div class="body-wrapper">

            @yield('body')

        </div>

        @include('admin.templates.includes.footer')

    </section>

    <script src="/assets/js/admin/main.min.js"></script>
    <script src="/assets/js/admin/charts.min.js"></script>
    <script src="/assets/js/admin/color.min.js"></script>
    <script src="/assets/js/admin/glightbox.min.js"></script>
    <script src="/assets/js/admin/lib/toastify.min.js"></script>
    <script src="/assets/js/admin/lib/highlight/highlight.min.js"></script>
    <script src="/assets/js/admin/quill.min.js"></script>
    <script src="/assets/js/admin/quill.resize.min.js"></script>
    <script src="https://unpkg.com/quill-paste-smart@latest/dist/quill-paste-smart.js"></script>

    @yield('js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            if(__exists(__select('.editor'))) {

                var toolbarOptions = [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ];

                var toolbarOptionsMin = [
                    ['bold', 'italic'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['image'],
                    ['link'],
                    ['clean']
                ];

                var normalEditor = [];

                __selectAll('.editor').forEach(function(elem) {

                    normalEditor[elem.getAttribute('id')] = new Quill('#'+ elem.getAttribute('id'),
                    {
                        theme: 'snow',
                        modules: {
                            toolbar: ((typeof elem.dataset.toolbar === 'undefined' || elem.dataset.toolbar === '') ? toolbarOptions : toolbarOptionsMin),
                            imageResize: { displaySize: true }
                        },
                        placeholder: ((typeof elem.dataset.placeholder !== 'undefined') ? elem.dataset.placeholder : '')
                    })

                })

            }

            if(__exists(__select('.editor-code'))) {

                var codeEditor = [];

                __selectAll('.editor-code').forEach(function(elem) {

                    hljs.configure({ languages: [ 'css', 'javascript' ] });

                    codeEditor[elem.getAttribute('id')] = new Quill('#'+ elem.getAttribute('id'), {

                        modules: {
                            syntax: true,
                            toolbar: false
                        },

                        theme: 'snow'

                    });

                });

            }

        })
    </script>

</body>
</html>
