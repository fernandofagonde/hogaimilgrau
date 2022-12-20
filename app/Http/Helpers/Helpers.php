<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;

class Helpers
{

    /**
     * loginAlert Messages
     *
     * @param  mixed $notifyType
     * @return void
     */

    public static function loginAlert( $notifyType) {

        switch($notifyType) {

            case 'success-login':
                $notifyType = 'success';
                $notifyMessage = Html::icon('icon-check') . ' Identificação efetuada com sucesso!';
                break;

            case 'error-email':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-mail') . ' Endereço de E-mail não cadastrado!';
                break;

            case 'error-password':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-lock') . ' Senha incorreta!';
                break;

            case 'error-login':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-lock') . ' É preciso identificar-se para utilizar a plataforma!';
                break;

            case 'logout':
                $notifyType = 'info';
                $notifyMessage = 'Sessão encerrada!';
                break;

        }

        echo Html::alert($notifyType, $notifyMessage);

    }

    /**
     * formAlert Messages
     *
     * @param  mixed $notifyType
     * @return void
     */

    public static function formAlert( $notifyType, $route = '' ) {

        switch($notifyType) {

            case 'success-add':
                $notifyType = 'success';
                $notifyMessage = Html::icon('icon-check') . ' Registro adicionado com sucesso!';
                break;

            case 'success-edit':
                $notifyType = 'success';
                $notifyMessage = Html::icon('icon-check') . ' Registro salvo com sucesso!';
                break;

            case 'success-del':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-check') . ' Registro excluído com sucesso!';
                break;

            case 'not-permited':
                $notifyType = 'warning';
                $notifyMessage  = Html::icon('icon-alert-circle') . ' Você não tem permissão para gerenciar este item!';
                break;

            case 'error-edit':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-times') . ' Não foi possível alterar o registro!';
                break;

            case 'search-results':
                $notifyType = 'info';
                $notifyMessage  = Html::icon('icon-filter') . ' Resultados filtrados por sua busca, <a href="'. route($route .'.index') .'">veja todos os registros</a>';
                break;

            case 'success-del-attachment':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-check') . ' Arquivo excluído sucesso!';
                break;

            case 'profile-password':
                $notifyType = 'danger';
                $notifyMessage = Html::icon('icon-times') . ' Password atual incorreto, tente novamente!';
                break;

        }

        if(isset($notifyMessage)) {

            echo Html::alert($notifyType, $notifyMessage);

        }

    }

    /**
     * formError
     *
     * @param  mixed $errorMessage
     * @return void
     */
    public static function formError( $errorMessage) {

        return '<div class="form-error">'. $errorMessage .'</div>';

    }

    /**
     * adminSidebarLinks
     *
     * @return void
     */
    private static function adminSidebarLinks () {

        /*
            LinkTree Instructions

            -----
            Icons
            -----
            See icons on /admin/list-icons, when identified
            Optional, default 'icon-circle'

            -----------------------------------
            Pattern for LinkTree // Single Link
            -----------------------------------

            [
                'icon' => 'icon-filter',
                'label' => 'Categorias',
                'url' => 'categorias'
            ],

            ...

            -------------------------------
            Pattern for LinkTree // Submenu
            -------------------------------

            [
                'icon' => 'icon-file-text',
                'label' => 'Publicações',
                'links' => [

                    [
                        'label' => 'Listar',
                        'url' => 'publicacoes'
                    ],

                    [
                        'icon' => 'icon-plus',
                        'label' => 'Adicionar',
                        'url' => 'publicacoes/add'
                    ],

                    ...

                ]
            ],
            ...

        */

        $LinkTree = [

            // Home
            [
                'icon' => 'icon-activity',
                'label' => 'Dashboard',
                'url' => ''
            ],

            // Settings
            [
                'icon' => 'icon-settings',
                'label' => 'Configurações',
                'links' => [

                    [
                        'icon' => 'icon-users',
                        'label' => 'Usuários',
                        'url' => 'settings-users'
                    ],

                    [
                        'icon' => 'icon-settings',
                        'label' => 'Geral',
                        'url' => 'settings-general'
                    ],

                    [
                        'icon' => 'icon-mail',
                        'label' => 'Servidor de E-mail',
                        'url' => 'settings-email'
                    ],

                    [
                        'icon' => 'icon-bell',
                        'label' => 'Serviço de Push',
                        'url' => 'settings-webpushr'
                    ],

                    [
                        'icon' => 'icon-share-alt',
                        'label' => 'Redes Sociais',
                        'url' => 'settings-social-media'
                    ],

                ]
            ],

            // Support
            [
                'icon' => 'icon-help',
                'label' => 'Suporte',
                'links' => [

                    [
                        'icon' => 'icon-mail',
                        'label' => 'E-mails de Contato',
                        'url' => 'support-email'
                    ],

                    [
                        'icon' => 'icon-whatsapp',
                        'label' => 'Contatos de WhatsApp',
                        'url' => 'support-whatsapp'
                    ],

                    [
                        'icon' => 'icon-help-circle',
                        'label' => 'FAQ',
                        'url' => 'support-faq'
                    ],

                ]
            ],

            // Content
            [
                'icon' => 'icon-file-text',
                'label' => 'Conteúdo',
                'links' => [

                    [
                        'icon' => 'icon-file',
                        'label' => 'Páginas',
                        'url' => 'content-pages'
                    ],

                    [
                        'icon' => 'icon-file-text',
                        'label' => 'Textos',
                        'url' => 'content-texts'
                    ]
                ]
            ],

            // Blog
            [
                'icon' => 'icon-bookmark',
                'label' => 'Blog',
                'links' => [

                    [
                        'icon' => 'icon-filter',
                        'label' => 'Categorias',
                        'url' => 'blog-categories'
                    ],

                    [
                        'icon' => 'icon-file-text',
                        'label' => 'Publicações',
                        'url' => 'blog-posts'
                    ],

                ]

            ],

            // Work
            [
                'icon' => 'icon-briefcase',
                'label' => 'Jobs',
                'links' => [

                    [
                        'icon' => 'icon-filter',
                        'label' => 'Serviços',
                        'url' => 'jobs-services'
                    ],

                    [
                        'icon' => 'icon-file-text',
                        'label' => 'Jobs',
                        'url' => 'jobs'
                    ],

                ]

            ],

            // Marketing
            [
                'icon' => 'icon-bullhorn',
                'label' => 'Marketing',
                'links' => [

                    [
                        'icon' => 'icon-slides',
                        'label' => 'Banners Slides',
                        'url' => 'marketing-slides'
                    ],

                    [
                        'icon' => 'icon-file-text',
                        'label' => 'Campanhas Push',
                        'url' => 'marketing-push'
                    ],

                    [
                        'icon' => 'icon-file-text',
                        'label' => 'Landing Pages',
                        'url' => 'marketing-landing-pages'
                    ],

                ]

            ],

            // Newsletter
            [
                'icon' => 'icon-newspaper',
                'label' => 'Newsletter',
                'links' => [

                    [
                        'icon' => 'icon-cog',
                        'label' => 'Configurações',
                        'url' => 'newsletter-settings'
                    ],

                    [
                        'icon' => 'icon-users',
                        'label' => 'Usuários',
                        'url' => 'newsletter-users'
                    ],

                    [
                        'icon' => 'icon-envelope',
                        'label' => 'Mensagens',
                        'url' => 'newsletter-messages'
                    ],

                ]

            ],

        ];

        return $LinkTree;

    }


    /**
     * adminSidebarLinks
     *
     * @return void
     */
    private static function appSidebarLinks () {

        /*
            LinkTree Instructions

            -----
            Icons
            -----
            See icons on /admin/list-icons, when identified
            Optional, default 'icon-circle'

            -----------------------------------
            Pattern for LinkTree // Single Link
            -----------------------------------

            [
                'icon' => 'icon-filter',
                'label' => 'Categorias',
                'url' => 'categorias'
            ],

            ...

            -------------------------------
            Pattern for LinkTree // Submenu
            -------------------------------

            [
                'icon' => 'icon-file-text',
                'label' => 'Publicações',
                'links' => [

                    [
                        'label' => 'Listar',
                        'url' => 'publicacoes'
                    ],

                    [
                        'icon' => 'icon-plus',
                        'label' => 'Adicionar',
                        'url' => 'publicacoes/add'
                    ],

                    ...

                ]
            ],
            ...

        */

        $LinkTree = [

            // Home
            [
                'icon' => 'icon-activity',
                'label' => 'Dashboard',
                'url' => ''
            ],

            // People
            [
                'icon' => 'icon-users',
                'label' => 'Pessoas',
                'links' => [

                    [
                        'icon' => 'icon-plus',
                        'label' => 'Cadastro',
                        'url' => 'people/create'
                    ],

                    [
                        'icon' => 'icon-list',
                        'label' => 'Listar',
                        'url' => 'people'
                    ]

                ]
            ],

            // Payable Bills
            [
                'icon' => 'icon-minus-square',
                'label' => 'Contas à Pagar',
                'links' => [

                    [
                        'icon' => 'icon-plus',
                        'label' => 'Cadastro',
                        'url' => 'payable-bills/create'
                    ],

                    [
                        'icon' => 'icon-list',
                        'label' => 'Listar',
                        'url' => 'payable-bills'
                    ]

                ]
            ],

            // Receivable Bills
            [
                'icon' => 'icon-plus-square',
                'label' => 'Contas à Receber',
                'links' => [

                    [
                        'icon' => 'icon-plus',
                        'label' => 'Cadastro',
                        'url' => 'receivable-bills/create'
                    ],

                    [
                        'icon' => 'icon-list',
                        'label' => 'Listar',
                        'url' => 'receivable-bills'
                    ]

                ]
            ],

        ];

        return $LinkTree;

    }


    /**
     * sidebar
     *
     * @return void
     */

    public static function sidebar( $Type ) {

        $Route = explode('/', request()->path());

        $LinkTree = ($Type == 'admin') ? self::adminSidebarLinks() : self::appSidebarLinks();
        $LinkGroup = $Type;

        /* Html for Menu */
        $Html = '';

        /* Mount Menu */

        foreach ($LinkTree as $Link) {

            // Simple Links
            if(!isset($Link['links'])) {

                $Url = isset($Link['url']) && $Link['url'] != '' ? $Link['url'] : '';
                $Icon = Html::icon((isset($Link['icon']) && $Link['icon'] != '') ? $Link['icon'] : 'icon-circle');

                $Html .= '
                <li'. ((in_array($Link['url'], $Route)) ? ' class="active"' : '') .'>
                    <a href="'. url($LinkGroup .'/'. $Url) .'">
                        '. $Icon .'
                        <span class="link-name">'. $Link['label'] .'</span>
                    </a>
                </li>';

            }

            // Submenu Links
            else {

                $LinksSubmenu = '';
                $CountLinks = 0;
                $isActive = false;

                foreach($Link['links'] as $SubmenuLinks) {

                    if(!$isActive) {

                        $isActive = (in_array($SubmenuLinks['url'], $Route));

                    }

                    $Icon = Html::icon((isset($SubmenuLinks['icon']) && $SubmenuLinks['icon'] != '') ? $SubmenuLinks['icon'] : 'icon-circle');

                    if($SubmenuLinks['label'] == 'divider') {

                        $LinksSubmenu .= '<li class="divider"></li>';

                    }
                    else {

                        $LinksSubmenu .= '
                        <li>
                            <a href="'. url($LinkGroup .'/'. $SubmenuLinks['url']) .'">
                                '. $Icon .'
                                <span class="link-name">'. $SubmenuLinks['label'] .'</span>
                            </a>
                        </li>
                        ';

                    }

                    $CountLinks++;

                }

                if($CountLinks > 0) {

                    $Icon = Html::icon((isset($Link['icon']) && $Link['icon'] != '') ? $Link['icon'] : 'icon-circle');

                    $Html .= '<li'. (($isActive) ? ' class="active"' : '') .'>
                        <div class="has-submenu">
                            <a href="#">
                                '. Html::icon($Link['icon']) .'
                                <span class="link-name">'. $Link['label'] .'</span>
                                '. Html::icon('icon-chevron-down arrow') .'
                            </a>

                        </div>
                        <ul class="nav-submenu">

                            <li><span class="submenu-header">'. $Link['label'] .'</span></li>

                            '. $LinksSubmenu .'

                        </ul>

                    </li>';

                }
            }

        }

        return '<ul class="nav-links">' . $Html .'</ul>';

    }

    /**
     * moduleBar
     *
     * @param  mixed $Route
     * @param  mixed $Add
     * @param  mixed $Placeholder
     * @param  mixed $Keywords
     * @param  mixed $JumpFields
     * @return void
     */

    public static function moduleBar( $Route, $Add = true, $Keywords = '', $Placeholder = '', $otherFields = '') {

        $html = '<div id="module-bar" class="active">

            '. (($Add) ? '<a href="'. route($Route .'.create') .'" title="Adicionar" class="button button-success">'. Html::icon('icon-plus') .'Adicionar</a>' : '') .'

            <div class="input-search">
                <form action="'. route($Route .'.search') .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'" />

                    '. $otherFields .'
                    <input type="text" name="keywords" class="form-control keywords" placeholder="'. $Placeholder .'" value="'. $Keywords .'" />
                    <button type="submit" class="button button-primary btn-search">'. Html::icon('icon-search') .'</button>
                </form>
            </div>

        </div>';

        return Main::minifyHtml($html);

    }


    public static function destinationControl($returnMethod, $route, $varName, $id) {

        $destination = '';
        $parameters = [];

        if($returnMethod == 'no') {

            $destination = $route . 'index';
            $parameters = [];

        }
        else if($returnMethod == 'create') {

            $destination = $route . 'create';
            $parameters = [];

        }
        else if($returnMethod == 'edit') {


            $destination = $route . 'edit';
            $parameters = [
                $varName => $id
            ];

        }

        return [
            'destination' => $destination,
            'parameters' => $parameters
        ];

    }
}
