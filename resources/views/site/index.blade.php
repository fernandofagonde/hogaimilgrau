<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/site/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/site/hamburgers.min.css" />
    <link rel="stylesheet" href="/assets/css/site/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Hogai</title>
  </head>
  <body>
    <!--loading-->
    <div class="loading loading__active d-flex align-items-center justify-content-center" data-loading>
      <img class="img-fluid" src="/assets/images/site/login-logo.png" alt="logo" />
    </div>

    <!--------------menu----------------------->
    <div class="menu" data-menu>
      <div class="container">
        <div class="menu__wrapper">
          <ul>
            <li><a data-links href="#home">Home</a></li>
          </ul>
          <ul>
            <li><a data-links href="#diferenciais">Diferenciais</a></li>
          </ul>
          <ul>
            <li><a data-links href="#planos">Planos e Preços</a></li>
          </ul>
          <ul>
            <li><a data-links href="#footer">Contato</a></li>
          </ul>

          <div class="line"></div>

          <a data-links class="menu__logo" href="#home"
            ><img src="/assets/images/site/login-logo.png" alt="Hogai"/></a>
        </div>
      </div>
    </div>

    <!--------------------modal de cadastro------------------------->
    <div class="cadastro" data-cadastro>

        <div class="row h-100">
          <div
            class="col-md-6 cadastro__logo d-flex justify-content-center align-items-center"
          >
            <img
              class="img-fluid"
              src="/assets/images/site/modal-logo.png"
              alt="logo da empresa Hogai"
            />
          </div>

          <div
            class="col-md-6 relative cadastro__form d-flex justify-content-center align-items-center flex-column"
          >

          <div class="d-flex justify-content-end">
            <div class="close" data-close>
              <svg class="close__modal" id="burger" xmlns="http://www.w3.org/2000/svg" width="31.619" height="34.223" viewBox="0 0 31.619 34.223">
                <rect id="Retângulo_177" data-name="Retângulo 177" width="41" height="5" rx="2.5" transform="matrix(0.682, 0.731, -0.731, 0.682, 3.657, 0.828)" fill="#073b4c"/>
                <rect id="Retângulo_178" data-name="Retângulo 178" width="41" height="5" rx="2.5" transform="translate(0.947 30.943) rotate(-49)" fill="#073b4c"/>
              </svg>

            </div>
          </div>
            <form action="">
              <h2>Crie o seu site em 2 minutos</h2>
              <p>Insira seu e-mail para começarmos.</p>

              <input class="custom__input" type="email" name="email" id="email" placeholder="Seu e-mail">

              <button type="submit" class="cta-btn mt-3">Continuar</button>
            </form>


            </div>
          </div>
        </div>

           <!--------------------modal de login------------------------->

    <div class="bg"></div>
    <div class="modal__login" data-login>

        <div class="d-flex justify-content-between">
            <img class="max-w-logo" src="/assets/images/site/login-logo.png" alt="logo da empresa Hogai" />
            <svg data-close class="close__modal" id="burger" xmlns="http://www.w3.org/2000/svg" width="31.619" height="34.223" viewBox="0 0 31.619 34.223">
                <rect id="Retângulo_177" data-name="Retângulo 177" width="41" height="5" rx="2.5" transform="matrix(0.682, 0.731, -0.731, 0.682, 3.657, 0.828)" fill="#073b4c"/>
                <rect id="Retângulo_178" data-name="Retângulo 178" width="41" height="5" rx="2.5" transform="translate(0.947 30.943) rotate(-49)" fill="#073b4c"/>
            </svg>
        </div>

        <div class="login-body">

            <h2>Faça o login ou cadastre-se</h2>

            <div id="login-errors"></div>

            <form name="login-form" class="container__form" action="{{ route('site.signin') }}" method="POST" target="_blank">
                @csrf

                <input class="custom__input" type="email" name="email" id="email" placeholder="Seu e-mail">

                <input class="custom__input" type="password" name="password" id="password" placeholder="Seu password">

                <button type="button" class="cta-btn my-4" id="login-button">Identificar-se!</button>

                <p>Ainda não tem cadastro? <a style="color:rgb(6 214 160);text-decoration:none;" href="#">Cadastre-se aqui!</a></p> @php /*{{ route('site.signup') }}*/ @endphp

            </form>

        </div>
    </div>


    <!------------------------modal de precos------------------------->
    <div class="modal-precos" data-modal-precos>
      <div class="container">
        <div class="d-flex justify-content-end">
          <div class="close__precos" data-close>
            <svg class="close__modal" id="burger" xmlns="http://www.w3.org/2000/svg" width="31.619" height="34.223" viewBox="0 0 31.619 34.223">
              <rect id="Retângulo_177" data-name="Retângulo 177" width="41" height="5" rx="2.5" transform="matrix(0.682, 0.731, -0.731, 0.682, 3.657, 0.828)" fill="#073b4c"/>
              <rect id="Retângulo_178" data-name="Retângulo 178" width="41" height="5" rx="2.5" transform="translate(0.947 30.943) rotate(-49)" fill="#073b4c"/>
            </svg>

          </div>
        </div>


          <div class="row justify-content-between">

            <div class="col-md-3 precos__box">

                <h4>Essencial</h4>

                <p>Plano básico - 100% editável.
                  (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
                  e-mails - sem propagandas). </p>

                <span class="preco__mes essential" data-modal-checkout><b>R$69,90</b>/mes</span>

                <div class="max-w-preco">

                  <div class="d-flex align-items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Home</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Conheça-nos</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Ministérios</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Agenda</h6>
                  </div>
                  <div class="preco__line"></div>


                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Usuários Ilimitados</h6>
                  </div>
                  <div class="preco__line"></div>


                  <p class="my-4">Taxa de Setup:
                    Criação, Implantação e Treinamento.
                    R$ 399,00 - Pagamento único.</p>


                  <div class="d-flex justify-content-center">
                    <button class="precos__btn essential" data-cadastro-btn>
                      Comece agora
                    </button>
                  </div>

                </div>
            </div>


            <div class="col-md-3 precos__box">

              <h4>Transição</h4>

              <p>Plano intermediário - 100% editável.
                (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
                e-mails - sem propaganda).</p>

              <span class="preco__mes transicao melhor" data-cadastro-btn>
                <b>R$99,90</b>/mes
                <span class="melhor__preco">
                  Melhor valor
                </span>
              </span>

              <div class="max-w-preco">

                <div class="d-flex align-items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Plano Essencial +</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Mídias, Fotos e Vídeos</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>"Seja um doador"</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Redes Sociais e Ofertas </h6>
                </div>
                <div class="preco__line"></div>


                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Cultos e Eventos</h6>
                </div>
                <div class="preco__line"></div>


                <p class="my-4">Taxa de Setup:
                  Criação, Implantação e Treinamento.
                  R$ 999,00 - Pagamento único.</p>


                <div class="d-flex justify-content-center">
                  <button class="precos__btn transicao" data-cadastro-btn>
                    Comece agora
                  </button>
                </div>

              </div>
          </div>


          <div class="col-md-3 precos__box">

            <h4>Amplo</h4>

            <p>Plano Completo - 100% editável.
              (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
              e-mails - sem propaganda).</p>

            <span class="preco__mes amplo" data-cadastro-btn><b>R$119,90</b>/mes</span>

            <div class="max-w-preco">

              <div class="d-flex align-items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Plano Transição +</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Ensino e Congressos</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Células, Grupos Caseiros e PG</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Notícias e Podcasts</h6>
              </div>
              <div class="preco__line"></div>


              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Cultos online</h6>
              </div>
              <div class="preco__line"></div>


              <p class="my-4">Taxa de Setup:
                Criação, Implantação e Treinamento.
                R$ 1.199,00 - Pagamento único.</p>


              <div class="d-flex justify-content-center">
                <button class="precos__btn amplo" data-cadastro-btn>
                  Comece agora
                </button>
              </div>

            </div>
        </div>

      </div>
      </div>
    </div>


     <!------------------------modal de checkout------------------------->

     <div class="modal-checkout" data-checkout>

      <div class="d-flex justify-content-end">
        <div class="close__precos" data-close>
          <svg class="close__modal" id="burger" xmlns="http://www.w3.org/2000/svg" width="31.619" height="34.223" viewBox="0 0 31.619 34.223">
            <rect id="Retângulo_177" data-name="Retângulo 177" width="41" height="5" rx="2.5" transform="matrix(0.682, 0.731, -0.731, 0.682, 3.657, 0.828)" fill="#073b4c"/>
            <rect id="Retângulo_178" data-name="Retângulo 178" width="41" height="5" rx="2.5" transform="translate(0.947 30.943) rotate(-49)" fill="#073b4c"/>
          </svg>

        </div>
      </div>



        <h2>Finalizar sua
          assinatura</h2>
        <div class="row">

          <div class="col-md-6">

            <section class="checkout__box d-flex justify-content-between align-items-center">

              <div class="form-check">
                <input class="form-check-input" type="radio" name="pacote" id="pacote1" value="69.90" checked data-essencial>
                <label class="form-check-label" for="pacote1">
                  Essencial
                </label>
                <p>Plano básico 100% editável.
                  (Registro Dominio + Hospedagem de site, Banco de dados + Contas de e-mails e sem propaganda).</p>
              </div>

              <div class="checkout__taxas d-flex flex-column align-items-end">
                <span><b>R$69,90</b>/mês</span>
                <p>Taxa de Setup:
                  Criação, Implantação e Treinamento.
                  R$ <b data-taxa-essencial>399,00</b> - Pagamento único.</p>
              </div>
            </section>


            <section class="checkout__box d-flex justify-content-between align-items-center my-4">

              <div class="form-check">
                <input class="form-check-input" type="radio" value="99.90" name="pacote" id="pacote2" data-transicao>
                <label class="form-check-label" for="pacote2">
                  Transição
                </label>
                <p>Plano intermediário 100% editável.
                  (Registro Dominio + Hospedagem de site, Banco de dados + Contas de e-mails e sem propaganda).</p>
              </div>

              <div class="checkout__taxas d-flex flex-column align-items-end">
                <span><b>R$99,90</b>/mês</span>
                <p>Taxa de Setup:
                  Criação, Implantação e Treinamento.
                  R$ <b data-taxa-transicao>999,00</b> - Pagamento único.</p>
              </div>
            </section>

            <section class="checkout__box d-flex justify-content-between align-items-center my-4">

              <div class="form-check">
                <input class="form-check-input" type="radio" value="119.90" name="pacote" id="pacote3" data-amplo>
                <label class="form-check-label" for="pacote3">
                  Amplo
                </label>
                <p>Plano Completo 100% editável.
                  (Registro Dominio + Hospedagem de site, Banco de dados + Contas de e-mailse sem propaganda).</p>
              </div>

              <div class="checkout__taxas d-flex flex-column align-items-end">
                <span><b>R$119,90</b>/mês</span>
                <p>Taxa de Setup:
                  Criação, Implantação e Treinamento.
                  R$ <b data-taxa-amplo>1199,00</b> - Pagamento único.</p>
              </div>
            </section>

          </div>



          <div class="col-md-6">

            <div class="checkout__tipo d-flex justify-content-center gap-3">

              <div class="form-check checkout__container d-flex flex-column justify-content-center align-items-center checkout__ativo">
                <input class="form-check-input" type="radio" name="metodo" id="cartao" checked data-metodo>
                <label class="form-check-label d-flex flex-column mt-3" for="cartao">
                  <img class="img-fluid" src="/assets/images/site/credit-card.png" alt="cartão de crédito" />
                  <b>Cartão de crédito</b>
                </label>
              </div>

              <div class="form-check checkout__container d-flex flex-column justify-content-center align-items-center">
                <input class="form-check-input" type="radio" name="metodo" id="boleto" data-metodo>
                <label class="form-check-label d-flex flex-column mt-3" for="boleto">
                  <img class="img-fluid" src="/assets/images/site/boleto.png" alt="boleto" />
                  <b>Boleto</b>
                </label>
              </div>

              <div class="form-check checkout__container d-flex flex-column justify-content-center align-items-center">
                <input class="form-check-input" type="radio" name="metodo" id="pix" data-metodo>
                <label class="form-check-label d-flex flex-column mt-3" for="pix">
                  <img class="img-fluid" src="/assets/images/site/pix.png" alt="pix" />
                  <b>Pix</b>
                </label>
              </div>
            </div>

            <!----------------------------Metodo de cartão--------------------->

            <form action="" class="checkout__form mt-4">

              <div class="" data-cartao-box>
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Nome do cartão</label>
                      <input type="text" class="custom__input" id="nome" placeholder="Digite aqui">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="validade">Expira</label>
                    <select class="custom__select" aria-label="Valor padrão selecionado">
                      <option selected>11/24</option>
                      <option value="1">11/26</option>
                      <option value="2">11/27</option>
                      <option value="3">11/28</option>
                    </select>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="credit__card" class="form-label">Número do Cartão</label>
                      <input type="text" class="custom__input" id="credit__card" placeholder="**** **** **** ****">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="cvv" class="form-label">CVV</label>
                      <input type="text" class="custom__input" id="cvv" placeholder="***">
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="cnpj" class="form-label">CPF/CNPJ</label>
                      <input type="text" class="custom__input" id="cnpj" placeholder="Digite aqui">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label>Detalhes</label>
                    <div class="detalhes d-flex flex-column justify-content-between">
                      <h6>Taxa de setup(única): <b data-taxa>R$ 399,00</b></h6>

                      <h6>Assinatura mensal: <b data-mensal>R$ 69,90</b></h6>

                      <h6>Total(tx+mensal): <b data-total>R$ 468,90</b></h6>
                    </div>
                  </div>

                </div>
              </div>


              <!----------------------------Metodo de boleto--------------------->

            <div class="d-none mt-5" data-boleto-box>
              <p class="text">Pague com boleto</p>
              <div class="detalhes d-flex flex-column justify-content-between">
                <h6>Valor do documento: <b data-total>R$ 123,45</b></h6>

                <h6>Vencimento: <b>01/05/2022</b></h6>

                <h6>Nosso número: <b>14/0000000000030019-0</b></h6>

                <h6>CPF/CNPJ: <b>97346258000186</b></h6>

                <h6>Número do documento: <b>000030019</b></h6>

                <img class="max-w-bar" src="/assets/images/site/barcode.png" alt="código de barras"/>
              </div>
            </div>

         <!----------------------------Metodo de pix--------------------->

         <div class="d-none mt-5 text-center" data-pix-box>
           <p class="text">Pague com Pix</p>
          <img class="img-fluid max-w-pix"  src="https://banco.bradesco/assets/classic/img/home/qrcode-pf.png" alt="código QR do pix" />
          </div>

          <div class="d-flex justify-content-md-end justify-content-center mt-5">
            <button class="cta-btn btn-full">Confirmar</button>
          </div>


            </form>



          </div>


        </div>


     </div>


    <header class="hero" id="home">
      <div class="container">
        <nav class="d-flex justify-content-between align-items-center py-4" data-normal-nav>

          <button class="hamburger hamburger--slider" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>

          <div class="logo" data-cadastro-btn>
            <svg id="simbolo" xmlns="http://www.w3.org/2000/svg" width="68.076" height="69.842" viewBox="0 0 68.076 69.842">
            <path id="Caminho_381" data-name="Caminho 381" d="M785.821,391.3a2.159,2.159,0,0,1-1.941-.178,1.889,1.889,0,0,1-.357-.27c-1.656-1.632-13.156-16.206-26.041-29.1-12.6-12.61-26.6-23.544-28.2-25.158a2.036,2.036,0,1,1,2.873-2.882c1.609,1.6,12.772,15.475,25.329,28.04,12.929,12.936,27.261,24.569,28.907,26.222a1.977,1.977,0,0,1,.462,2.31A1.9,1.9,0,0,1,785.821,391.3Z" transform="translate(-724.573 -327.25)" fill="#f4f4f6"/>
            <path id="Caminho_382" data-name="Caminho 382" d="M729.263,391.732a2.157,2.157,0,0,1,.174-1.946,1.865,1.865,0,0,1,.267-.353c1.449-1.471,26.756-24.288,28.526-26.06,1.624-1.624,24.336-26.857,25.7-28.212a2.036,2.036,0,1,1,2.891,2.866c-1.354,1.365-26.967,23.722-28.59,25.346-13.2,13.2-23.954,27.236-25.644,28.918a1.98,1.98,0,0,1-2.309.469A1.9,1.9,0,0,1,729.263,391.732Z" transform="translate(-725 -328.528)" fill="#f4f4f6"/>
            <path id="Caminho_383" data-name="Caminho 383" d="M758.117,577.4c-1.338-.005-30.563,1.86-32.7,1.861-2.044,0-26.016-1.5-31.112-1.824a1.987,1.987,0,0,0-1.593.644l-.01.01a1.993,1.993,0,0,0,0,2.69h0a1.987,1.987,0,0,0,1.616.642c5.126-.383,29.056-2.163,31.1-2.163,2.137,0,31.358,2.227,32.715,2.212a2.039,2.039,0,1,0-.014-4.073Z" transform="translate(-692.18 -544.417)" fill="#f4f4f6"/>
            <path id="Caminho_384" data-name="Caminho 384" d="M972.952,315.782c0-13.241,1.4-29.39,1.752-32.828a1.973,1.973,0,0,0-.369-1.363l-.017-.024a1.974,1.974,0,0,0-3.191,0h0a1.971,1.971,0,0,0-.364,1.409,314.058,314.058,0,0,1,2.188,32.805c-.006,13.717-2.271,31.15-2.267,32.615a2.044,2.044,0,1,0,4.076,0C974.77,347.087,972.953,325.609,972.952,315.782Z" transform="translate(-939.715 -280.756)" fill="#f4f4f6"/>
            <path id="Caminho_385" data-name="Caminho 385" d="M879.311,339.981a1.923,1.923,0,0,1,1.7,1.184c.28.639,3.563,14.4,8.79,27.075,5.42,13.138,12.79,25.2,13.047,25.874a2.021,2.021,0,0,1-3.724,1.559c-.306-.674-3.858-14.189-9.323-27.433-5.189-12.577-12.305-24.916-12.545-25.576A2.039,2.039,0,0,1,879.311,339.981Z" transform="translate(-856.564 -333.395)" fill="#f4f4f6"/>
            <path id="Caminho_386" data-name="Caminho 386" d="M904.341,341.73a2.231,2.231,0,0,1-.078,1.076c-.016.052-.035.1-.055.156a237.568,237.568,0,0,0-12.794,25.325c-5.111,12.36-8.269,25.634-8.518,26.214a2.038,2.038,0,1,1-3.773-1.534,250.266,250.266,0,0,0,12.291-24.68,278.552,278.552,0,0,0,9.111-27.041,2,2,0,0,1,3.817.483Z" transform="translate(-858.182 -333.443)" fill="#f4f4f6"/>
            <path id="Caminho_387" data-name="Caminho 387" d="M738.428,504.521a1.881,1.881,0,0,1-2.595-.67,1.908,1.908,0,0,1-.162-.411,1.944,1.944,0,0,1,.979-2.305c.7-.323,14.138-3.866,27.35-9.338,12.683-5.252,25.161-12.442,25.856-12.695a1.98,1.98,0,0,1,2.423,1.119,1.931,1.931,0,0,1-.8,2.533c-1.42.686-16.335,4.452-27.478,9.044A238.882,238.882,0,0,0,738.428,504.521Z" transform="translate(-730.77 -456.953)" fill="#f4f4f6"/>
            <path id="Caminho_388" data-name="Caminho 388" d="M794.532,498.405a2.071,2.071,0,0,0-.014-.209c-.007-.059-.017-.117-.03-.174s-.031-.123-.05-.183-.03-.1-.05-.147a1.851,1.851,0,0,0-.667-.854,2.119,2.119,0,0,0-.395-.232c-.119-.053-.668-.283-1.564-.657-.214-.09-.429-.181-.644-.269-4.291-1.787-15.37-3.709-25.271-7.806-12.957-5.361-24.758-12.9-25.41-13.166a2.692,2.692,0,0,0-.573-.125,2.083,2.083,0,0,0-2.147,1.618,2.026,2.026,0,0,0,1.206,2.268c.637.279,13.9,4.013,26.924,9.405,8.992,3.724,17.811,9.139,22.516,11.079a20.433,20.433,0,0,0,2.713,1.116c.365.15.6.245.672.273a2.163,2.163,0,0,0,.364.1l.115.043.167-.012a1.994,1.994,0,0,0,1.787-.882,1.9,1.9,0,0,0,.35-1.057C794.535,498.493,794.533,498.449,794.532,498.405Z" transform="translate(-732.618 -453.029)" fill="#f4f4f6"/>
            <path id="Caminho_389" data-name="Caminho 389" d="M980,581.38a1.613,1.613,0,1,0-1.614,1.61A1.615,1.615,0,0,0,980,581.38Z" transform="translate(-945.124 -546.514)" fill="#f4f4f6" opacity="0.3"/>
          </svg>

          </div>

          <button class="login" data-modal-login>Log in</button>

        </nav>


        <!-----------------navbar fixa--------------------------->
        <nav id="nav__fixed" class="d-flex justify-content-between align-items-center py-4" data-nav>

          <button class="hamburger hamburger--slider" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>

          <div class="logo" data-cadastro-btn>
            <img class="logo__img" src="/assets/images/site/login-logo.png" alt="logo">

          </div>

          <button class="login__fixed" data-modal-login>Log in</button>

        </nav>


        <section class="hero__content text-white">
          <div class="row">
            <div
              class="col-md-6 order-md-1 d-flex flex-column justify-content-center align-items-end"
            >
              <img class="img-fluid" src="/assets/images/site/logo.png" alt="simbolo da empresa Hogay" />
            </div>

            <div
              class="col-md-6 order-md-0 d-flex flex-column justify-content-center"
            >
              <h1>Sua igreja digital agora descomplicou.</h1>
              <p>
                Tenha sua igreja também no modelo digital de forma simples,
                veloz e conectada com o mundo.
              </p>

              <button class="cta-btn" data-cadastro-btn>Comece agora</button>
            </div>
          </div>
        </section>
      </div>

      <div class="to__bottom d-flex justify-content-center">
        <a href="#footer"
          class="circle d-flex justify-content-center align-items-center"
          data-to-bottom
        >
          <img src="/assets/images/site/arrow.png" alt="seta apontando para baixo" />
        </a>
      </div>
    </header>


    <section class="diferenciais" id="diferenciais">

        <div class="container">

            <div class="container__text">
                <h2>Sua igreja digital em um caminho para o mundo</h2>
                <p>Saiba como descomplicamos a tecnologia para que sua marca, presença online e ações sejam conectadas e vistas mundialmente.</p>
            </div>

        </div>

        <div class="container mt-5">
          <div class="row gap-4 justify-content-center">

            <div class="col-md-6 diferenciais__box d-flex flex-column justify-content-between align-items-center gap-3">

              <svg xmlns="http://www.w3.org/2000/svg" width="81" height="81" viewBox="0 0 81 81">
                <g id="Grupo_134" data-name="Grupo 134" transform="translate(-0.312 -0.459)">
                  <circle id="Elipse_79" data-name="Elipse 79" cx="40.5" cy="40.5" r="40.5" transform="translate(0.312 0.459)" fill="#06d6a0"/>
                  <g id="user" transform="translate(19.978 20.126)">
                    <path id="Caminho_4" data-name="Caminho 4" d="M43.667,37.59V39.5A4.225,4.225,0,0,1,39.5,43.667H6.167A4.225,4.225,0,0,1,2,39.5V37.59C2,32.556,7.9,29.431,13.458,27l.521-.26a1.392,1.392,0,0,1,1.3.087,13.47,13.47,0,0,0,7.465,2.257,13.974,13.974,0,0,0,7.465-2.257,1.392,1.392,0,0,1,1.3-.087l.521.26C37.764,29.431,43.667,32.469,43.667,37.59ZM22.833,2c5.729,0,10.33,5.122,10.33,11.458s-4.6,11.458-10.33,11.458S12.5,19.8,12.5,13.458,17.1,2,22.833,2Z" transform="translate(-2 -2)" fill="#f4f4f6"/>
                  </g>
                </g>
              </svg>

              <div class="text-center">
                <h6>Visitantes e Membros</h6>

              <p>A plataforma Hogai® disponibiliza um controle de acessos e um cadastro de visitantes e membros com uma inteligência de dados capaz de aumentar o seu relacionamento e vincular as ações da sua eclésia.
              </p>
              </div>



            </div>


            <div class="col-md-6 diferenciais__box d-flex flex-column align-items-center gap-3">

              <div class="icone__svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="45.931" height="40.189" viewBox="0 0 45.931 40.189">
                  <g id="bar-chart-line-fill" transform="translate(0 -1)">
                    <path id="Caminho_394" data-name="Caminho 394" d="M3.871,10H9.612a2.871,2.871,0,0,1,2.871,2.871v8.612a2.871,2.871,0,0,1-2.871,2.871H3.871A2.871,2.871,0,0,1,1,21.483V12.871A2.871,2.871,0,0,1,3.871,10Z" transform="translate(1.871 16.836)" fill="#fff"/>
                    <path id="Caminho_395" data-name="Caminho 395" d="M8.871,6h5.741a2.871,2.871,0,0,1,2.871,2.871V28.965a2.871,2.871,0,0,1-2.871,2.871H8.871A2.871,2.871,0,0,1,6,28.965V8.871A2.871,2.871,0,0,1,8.871,6Z" transform="translate(11.224 9.353)" fill="#fff"/>
                    <path id="Caminho_396" data-name="Caminho 396" d="M13.871,1h5.741a2.871,2.871,0,0,1,2.871,2.871V38.319a2.871,2.871,0,0,1-2.871,2.871H13.871A2.871,2.871,0,0,1,11,38.319V3.871A2.871,2.871,0,0,1,13.871,1Z" transform="translate(20.577 0)" fill="#fff"/>
                    <path id="Caminho_397" data-name="Caminho 397" d="M0,15.435A1.435,1.435,0,0,1,1.435,14H44.5a1.435,1.435,0,1,1,0,2.871H1.435A1.435,1.435,0,0,1,0,15.435Z" transform="translate(0 24.319)" fill="#fff" fill-rule="evenodd"/>
                  </g>
                </svg>
              </div>

              <div class="text-center">
                <h6>Sustentabilidade</h6>
                <p>"Seja um doador" é um dos módulos que pode auxiliar suas ações e movimentos a ter um crescimento sustentável em todos os âmbitos da sua Igreja.
                </p>

              </div>

            </div>

            <div class="col-md-6 diferenciais__box d-flex flex-column justify-content-between align-items-center gap-3">

            <svg xmlns="http://www.w3.org/2000/svg" width="81" height="81" viewBox="0 0 81 81">
              <g id="Grupo_134" data-name="Grupo 134" transform="translate(-0.312 -0.459)">
                <circle id="Elipse_79" data-name="Elipse 79" cx="40.5" cy="40.5" r="40.5" transform="translate(0.312 0.459)" fill="#00dfef"/>
                <path id="Icon_simple-uikit" data-name="Icon simple-uikit" d="M38.288,7.339l-9.16,5.549L39.69,18.9V34.674L25.5,42.562,11.55,34.674V22.447l-9.156-4.71V40.127L25.175,53.5,48.781,40.127V13.38L38.288,7.339Zm-4.245-2.2L25.171,0,15.924,5.725l8.988,4.945,9.131-5.535Z" transform="translate(15.224 14.208)" fill="#f4f4f6"/>
              </g>
            </svg>


              <div class="text-center">
                <h6>Design</h6>
                <p>Um design com interfaces mais usuais e amigáveis elaborado em UI - User Interface Design, buscando sempre a experiência do usuário na interação como o produto ou serviço através do UX - User Experience.
                </p>
              </div>

            </div>


          </div>
        </div>

    </section>


    <section class="why">
      <div class="container">
        <div class="row justify-content-center gap-3">

          <div class="col-md-6">
            <img class="img-fluid" src="/assets/images/site/mockup.png" alt="produto sendo mostrado em um computador e um smartphone" />
          </div>

          <div class="col-md-5">
            <h2>Sua Igreja está online?
              Então hogai é para você.</h2>

              <p>Solução multiplataforma para que sua Igreja seja digital de forma eficiente e sem complexidade. Divulgue suas ações e movimentos para continuação e crescimento sustentável das missões no Brasil e no Mundo.</p>


            <div class="d-flex align-items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="22.208" height="22.208" viewBox="0 0 22.208 22.208">
                <g id="Icon_feather-layout" data-name="Icon feather-layout" transform="translate(-3 -3)">
                  <path id="Caminho_528" data-name="Caminho 528" d="M6.634,4.5h14.94a2.134,2.134,0,0,1,2.134,2.134v14.94a2.134,2.134,0,0,1-2.134,2.134H6.634A2.134,2.134,0,0,1,4.5,21.574V6.634A2.134,2.134,0,0,1,6.634,4.5Z" fill="none" stroke="#073b4c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                  <path id="Caminho_529" data-name="Caminho 529" d="M4.5,13.5H23.708" transform="translate(0 -2.597)" fill="none" stroke="#073b4c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                  <path id="Caminho_530" data-name="Caminho 530" d="M13.5,26.306V13.5" transform="translate(-2.597 -2.597)" fill="none" stroke="#073b4c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                </g>
              </svg>

              <p class="why__text">Temas Modernos e Intuitivos</p>
            </div>


            <div class="d-flex align-items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="21.041" height="21.041" viewBox="0 0 21.041 21.041">
                <path id="Icon_map-fullscreen" data-name="Icon map-fullscreen" d="M1.44,7.733V1.44H7.981l2.407,1.83H6.376l4.212,4.463-2.608,2.4-4.254-4V10.14ZM15.964,1.44h6.517V7.756l-1.83,2.406V6.152l-4.576,4.212-2.454-2.5,3.946-4.141H13.557Zm6.517,14.524v6.517H15.941l-2.407-1.83h4.011l-4.212-4.576,2.608-2.454,4.254,3.946V13.557ZM7.957,22.481H1.44V15.941l1.83-2.407v4.011l4.576-4.212L10.3,15.941,6.353,20.194h4.011Z" transform="translate(-1.44 -1.44)" fill="#073b4c"/>
              </svg>

              <p class="why__text">Facilidade de customização</p>
            </div>

            <div class="d-flex align-items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="22.547" height="26.006" viewBox="0 0 22.547 26.006">
                <path id="Icon_simple-uikit" data-name="Icon simple-uikit" d="M19.841,3.567l-4.452,2.7,5.134,2.921v7.668l-6.9,3.834L6.844,16.854V10.911l-4.45-2.29V19.5l11.073,6.5,11.474-6.5V6.5l-5.1-2.936ZM17.778,2.5,13.465,0,8.97,2.783l4.369,2.4L17.778,2.5Z" transform="translate(-2.394)" fill="#073b4c"/>
              </svg>


              <p class="why__text">Usabilidade baseada na experência do usuário</p>
            </div>

            <button class="cta-btn" data-cadastro-btn>Crie o seu</button>

          </div>
        </div>


      </div>
    </section>


    <section class="why">
      <div class="container">
        <div class="row justify-content-center gap-3">

          <div class="col-md-6 d-flex justify-content-end order-md-1 my-3">
            <img class="img-fluid" src="/assets/images/site/phones-mockup.png" alt="produto sendo mostrado em um smartphone" />
          </div>


          <div class="col-md-5 order-md-0 my-3">
            <h2>Conheça nossa transformação digital
            </h2>

              <p>Somos uma ferramenta de transformação digital que desempenha um papel importante na jornada de construção da sua marca e presença online.
                Hogai® é onipresente e em sua plataforma conta com um grande sistema de gerenciamento de conteúdo.</p>


            <div class="d-flex align-items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16">
                <path id="Icon_awesome-project-diagram" data-name="Icon awesome-project-diagram" d="M12,10H8a1,1,0,0,0-1,1v4a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1V11A1,1,0,0,0,12,10ZM6,1A1,1,0,0,0,5,0H1A1,1,0,0,0,0,1V5A1,1,0,0,0,1,6H3.991l2.286,4A1.993,1.993,0,0,1,8,9h.009L6,5.485V4h7V2H6ZM19,0H15a1,1,0,0,0-1,1V5a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1V1A1,1,0,0,0,19,0Z" fill="#073b4c"/>
              </svg>


              <p class="why__text">Gestão de conteúdo simplificado</p>
            </div>


            <div class="d-flex align-items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.5" viewBox="0 0 20 17.5">
                <g id="bar-chart-line-fill" transform="translate(0 -1)">
                  <path id="Caminho_394" data-name="Caminho 394" d="M2.25,10h2.5A1.25,1.25,0,0,1,6,11.25V15a1.25,1.25,0,0,1-1.25,1.25H2.25A1.25,1.25,0,0,1,1,15V11.25A1.25,1.25,0,0,1,2.25,10Z" transform="translate(0.25 2.25)" fill="#073b4c"/>
                  <path id="Caminho_395" data-name="Caminho 395" d="M7.25,6h2.5A1.25,1.25,0,0,1,11,7.25V16a1.25,1.25,0,0,1-1.25,1.25H7.25A1.25,1.25,0,0,1,6,16V7.25A1.25,1.25,0,0,1,7.25,6Z" transform="translate(1.5 1.25)" fill="#073b4c"/>
                  <path id="Caminho_396" data-name="Caminho 396" d="M12.25,1h2.5A1.25,1.25,0,0,1,16,2.25v15a1.25,1.25,0,0,1-1.25,1.25h-2.5A1.25,1.25,0,0,1,11,17.25v-15A1.25,1.25,0,0,1,12.25,1Z" transform="translate(2.75)" fill="#073b4c"/>
                  <path id="Caminho_397" data-name="Caminho 397" d="M0,14.625A.625.625,0,0,1,.625,14h18.75a.625.625,0,0,1,0,1.25H.625A.625.625,0,0,1,0,14.625Z" transform="translate(0 3.25)" fill="#073b4c" fill-rule="evenodd"/>
                </g>
              </svg>


              <p class="why__text">Onipresente em desktop, tablet e celular</p>
            </div>

            <div class="d-flex align-items-center gap-3">
              <svg id="calendar-check-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path id="Caminho_398" data-name="Caminho 398" d="M4,.5a.5.5,0,0,0-1,0V1H2A2,2,0,0,0,0,3V4H16V3a2,2,0,0,0-2-2H13V.5a.5.5,0,0,0-1,0V1H4ZM0,5H16v9a2,2,0,0,1-2,2H2a2,2,0,0,1-2-2ZM10.854,8.854a.5.5,0,0,0-.708-.708L7.5,10.793,6.354,9.646a.5.5,0,1,0-.708.708l1.5,1.5a.5.5,0,0,0,.708,0Z" fill="#073b4c" fill-rule="evenodd"/>
              </svg>


              <p class="why__text">Adaptado para as necessidades existentes</p>
            </div>

            <button class="cta-btn" data-precos-btn >Conheça agora</button>

          </div>



        </div>


      </div>
    </section>


    <section class="precos" id="planos">
      <div class="container">
        <h2>Invista no seu propósito</h2>
        <p>Um modelo que cabe no seu bolso, onde seus objetivos serão alcançados de forma plena. Esta é a nossa missão: ajudar você a se sentir seguro e, é claro,
          a investir com inteligência.</p>


          <div class="row justify-content-between">

            <div class="col-md-3 precos__box">

                <h4>Essencial</h4>

                <p>Plano básico - 100% editável.
                  (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
                  e-mails - sem propagandas). </p>

                <span class="preco__mes essential" data-modal-checkout><b>R$69,90</b>/mes</span>

                <div class="max-w-preco">

                  <div class="d-flex align-items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Home</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Conheça-nos</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Ministérios</h6>
                  </div>
                  <div class="preco__line"></div>

                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Agenda</h6>
                  </div>
                  <div class="preco__line"></div>


                  <div class="d-flex align-items-center gap-3 mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                      <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                    </svg>
                    <h6>Usuários Ilimitados</h6>
                  </div>
                  <div class="preco__line"></div>


                  <p class="my-4">Taxa de Setup:
                    Criação, Implantação e Treinamento.
                    R$ 399,00 - Pagamento único.</p>


                  <div class="d-flex justify-content-center">
                    <button class="precos__btn essential" data-modal-checkout>
                      Comece agora
                    </button>
                  </div>

                </div>
            </div>


            <div class="col-md-3 precos__box">

              <h4>Transição</h4>

              <p>Plano intermediário - 100% editável.
                (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
                e-mails - sem propaganda).</p>

              <span class="preco__mes transicao melhor" data-modal-checkout>
                <b>R$99,90</b>/mes

                <span class="melhor__preco">
                  Melhor valor
                </span>
              </span>

              <div class="max-w-preco">

                <div class="d-flex align-items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Plano Essencial +</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Mídias, Fotos e Vídeos</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>"Seja um doador"</h6>
                </div>
                <div class="preco__line"></div>

                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Redes Sociais e Ofertas </h6>
                </div>
                <div class="preco__line"></div>


                <div class="d-flex align-items-center gap-3 mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                    <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                  </svg>
                  <h6>Cultos e Eventos</h6>
                </div>
                <div class="preco__line"></div>


                <p class="my-4">Taxa de Setup:
                  Criação, Implantação e Treinamento.
                  R$ 999,00 - Pagamento único.</p>


                <div class="d-flex justify-content-center">
                  <button class="precos__btn transicao" data-modal-checkout>
                    Comece agora
                  </button>
                </div>

              </div>
          </div>


          <div class="col-md-3 precos__box">

            <h4>Amplo</h4>

            <p>Plano Completo - 100% editável.
              (Registro de Domínio + Hospedagem de site + Banco de dados + Contas de
              e-mails - sem propaganda).</p>

            <span class="preco__mes amplo" data-modal-checkout><b>R$119,90</b>/mes</span>

            <div class="max-w-preco">

              <div class="d-flex align-items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Plano Transição +</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Ensino e Congressos</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Células, Grupos Caseiros e PG</h6>
              </div>
              <div class="preco__line"></div>

              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Notícias e Podcasts</h6>
              </div>
              <div class="preco__line"></div>


              <div class="d-flex align-items-center gap-3 mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.648" height="21.852" viewBox="0 0 26.648 21.852">
                  <path id="Caminho_452" data-name="Caminho 452" d="M79.954,251.043l-4.73-4.725-12.394,12.4-4.795-4.8-4.73,4.731,9.518,9.52.006-.013.015.013Z" transform="translate(-53.306 -246.318)" fill="#073b4c"/>
                </svg>
                <h6>Cultos online</h6>
              </div>
              <div class="preco__line"></div>


              <p class="my-4">Taxa de Setup:
                Criação, Implantação e Treinamento.
                R$ 1.199,00 - Pagamento único.</p>


              <div class="d-flex justify-content-center">
                <button class="precos__btn amplo" data-modal-checkout>
                  Comece agora
                </button>
              </div>

            </div>
        </div>

      </div>
      </div>
    </section>

    <section class="qrcode">
      <div class="container">
        <div class="row">

          <div class="col-md-6 d-flex justify-content-end order-md-1">
            <img src="/assets/images/site/toten.png" class="img-fluid qrcode__toten" alt="toten"/>
          </div>

          <div class="col-md-6 qrcode__content order-md-0">
            <h2>QR Code é o seu novo jeito de receber contribuições</h2>
            <p>Não é Pix, mas você já imaginou receber contribuições das pessoas somente apontando a câmera do celular para o QR Code? Sim, isso é o que disponibilizamos para você. Pode ser colocado em qualquer lugar, como por exemplo, nas Igrejas, eventos, banners, materiais digitais, planfletos físicos, totens, entre outros. Simples e fácil.</p>
            <button class="cta-btn">
              Saiba mais
            </button>
          </div>

        </div>
      </div>
    </section>


    <footer id="footer">
      <div class="to__top d-flex justify-content-center">

        <a href="#home"
          class="footer__circle d-flex justify-content-center align-items-center"
          data-to-bottom
        >
          <img src="/assets/images/site/arrow.png" alt="seta apontando para baixo" />
        </a>
      </div>

      <div class="container">

        <div class="row justify-content-between">

          <div class="col-md-3">
            <img class="img-fluid" src="/assets/images/site/logo-footer.png" alt="logo" />

            <form class="form__footer">
              <p class="text-white">Crie seu site em apenas 2 minutos somente com seu e-mail.</p>

              <div class="footer__wrapper">
                <input type="email" name="email" id="email_footer" placeholder="Envie seu email"/>
                <button type="submit" class="footer__btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="27" height="22.5" viewBox="0 0 27 22.5">
                    <path id="Icon_ionic-md-navigate" data-name="Icon ionic-md-navigate" d="M11.25,0,0,25.95,1.05,27l10.2-4.5L21.45,27l1.05-1.05Z" transform="translate(27) rotate(90)" fill="#073b4c"/>
                  </svg>
                </button>
              </div>

            </form>
          </div>

          <div class="col-md-6">

            <div class="d-md-flex justify-content-between">
              <ul class="text-white">
                <h6>About</h6>

                <li class="list-unstyled"><a class="text-decoration-none text-white mt-4 d-block" href="#">Sobre nós</a></li>
                <li class="list-unstyled"><a class="text-decoration-none text-white my-2 d-block" href="#">Serviços</a></li>
              </ul>

              <ul class="text-white">
                <h6>Explore</h6>

                <li class="list-unstyled"><a class="text-decoration-none text-white mt-4 d-block" href="#">Criação de
                  Blog
                  </a></li>
                <li class="list-unstyled"><a class="text-decoration-none text-white my-2 d-block" href="#">Criação de Design</a></li>
              </ul>


              <ul class="text-white">
                <h6>Fale com a gente</h6>

                <li class="list-unstyled mt-4">+55 47 9991-4093
                </li>
                <li class="list-unstyled my-2">sac@gmail.com</li>
              </ul>
            </div>

            <div class="d-flex justify-content-end mt-5">
              <p class="text-white max-w-text">Bagé - Rio grande do Sul - Brasil
                Itajaí - Santa Catarina - Brasil</p>
            </div>


          </div>
        </div>

        <div class="d-md-flex flex-column align-items-end">

          <div class="d-flex flex-wrap align-items-center footer__direitos gap-2">
            <p>hogai® é um produto criado pelo programa de transformação digital da startup </p>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="79" height="22" viewBox="0 0 79 22">
              <defs>
                <pattern id="pattern" preserveAspectRatio="none" width="100%" height="100%" viewBox="0 0 281 78">
                  <image width="281" height="78" xlink:href="data:image/png;base64,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"/>
                </pattern>
              </defs>
              <rect id="LOGO_Y_2020_web_green" width="79" height="22" fill="url(#pattern)"/>
            </svg>

          </div>

          <p class="text-white mt-3">All rights reserved © hogai 2021.
          </p>

        </div>



      </div>
    </footer>
    <script src="https://unpkg.com/imask"></script>
    <script src="/assets/js/site/main.js"></script>
    <script src="/assets/js/site/js/observer.js"></script>
  </body>
</html>

