let burger = document.querySelectorAll(".hamburger");
let menu = document.querySelector("[data-menu]");
let cadastro = document.querySelector("[data-cadastro]");
let cadastroBtn = document.querySelectorAll("[data-cadastro-btn]");
let login = document.querySelector("[data-login]");
let loginBtn = document.querySelectorAll("[data-modal-login]");
let checkoutModal = document.querySelector("[data-checkout]");
let checkoutBtn = document.querySelectorAll("[data-modal-checkout]");
let closeModal = document.querySelectorAll("[data-close]");
let bg = document.querySelector(".bg");
let links = document.querySelectorAll("[data-links]");
let precosModal = document.querySelector("[data-modal-precos]");
let precosBtn = document.querySelector("[data-precos-btn]");
let metodo = document.querySelectorAll("[data-metodo]");


//fechar o loading
let loading = document.querySelector('[data-loading]')
setTimeout(()=>{loading.classList.remove('loading__active')},500)

//fechar o menu clicando nos links
links.forEach((link) => {
  link.addEventListener("click", () => {
    handleMenu();
  });
});

//acionar menu mobile
burger.forEach(btn => {
  btn.addEventListener("click", () => {
    handleMenu();
  });
})


const handleMenu = () => {
  burger.forEach(btn =>{
    btn.classList.toggle("is-active")
    if (btn.classList.contains("is-active")) {
      menu.classList.add("menu__active");
    } else {
      menu.classList.remove("menu__active");
    }
  })


};

//ativar modal da cadastro
cadastroBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    handleCadastro();
  });
});

//ativar modal de login
loginBtn.forEach(btn =>{
  btn.addEventListener("click", () => {
    handleLogin();
  });
})


//ativar modal de preços
precosBtn.addEventListener("click", () => {
  handleModalPrecos();
});

//ativar modal de checkout
checkoutBtn.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    if(e.target.classList.contains("essential")){
        mensal__essencial.checked = true;
        handleCalculoEssencial()
    }
    if(e.target.classList.contains("transicao")){
        mensal__transicao.checked = true;
        handleCalculoTransicao()
    }
    if(e.target.classList.contains("amplo")){
        mensal__amplo.checked = true;
        handleCalculoAmplo()
    }
    handleModalCheckout();
  });
});

//fechar modal
closeModal.forEach((btn) => {
  btn.addEventListener("click", () => {
    handleCloseModal();
  });
});

//fechar modal clicando fora
bg.addEventListener("click", () => {
  handleCloseModal();
});

const handleCadastro = () => {
  cadastro.classList.add("cadastro__active");
};

const handleLogin = () => {
  login.classList.add("cadastro__active");
  bg.classList.add("active");
  document.body.style.overflow = "hidden";
};

const handleModalPrecos = () => {
  precosModal.classList.add("cadastro__active");
  document.body.style.overflow = "hidden";
};

const handleModalCheckout = () => {
  checkoutModal.classList.add("cadastro__active");
  document.body.style.overflow = "hidden";
};

const handleCloseModal = () => {
  cadastro.classList.remove("cadastro__active");
  login.classList.remove("cadastro__active");
  precosModal.classList.remove("cadastro__active");
  checkoutModal.classList.remove("cadastro__active");
  bg.classList.remove("active");
  document.body.style.overflow = "auto";
};

const handleMetodoAtivo = () => {
  let cartao = document.getElementById("cartao");
  let boleto = document.getElementById("boleto");
  let pix = document.getElementById("pix");

  let cartaoBox = document.querySelector('[data-cartao-box]')
  let boletoBox = document.querySelector('[data-boleto-box]')
  let pixBox = document.querySelector('[data-pix-box]')

  metodo.forEach((tipo) => {
    tipo.addEventListener("change", () => {


      if (cartao.checked) {
        cartao.parentNode.classList.add("checkout__ativo");
        boleto.parentNode.classList.remove("checkout__ativo");
        pix.parentNode.classList.remove("checkout__ativo");
        cartaoBox.classList.remove("d-none")
        boletoBox.classList.add("d-none")
        pixBox.classList.add("d-none")
        return;
      }
      if (boleto.checked) {
        boleto.parentNode.classList.add("checkout__ativo");
        cartao.parentNode.classList.remove("checkout__ativo");
        pix.parentNode.classList.remove("checkout__ativo");
        boletoBox.classList.remove("d-none")
        cartaoBox.classList.add("d-none")
        pixBox.classList.add("d-none")
        return;
      }
      if (pix.checked) {
        pix.parentNode.classList.add("checkout__ativo");
        cartao.parentNode.classList.remove("checkout__ativo");
        boleto.parentNode.classList.remove("checkout__ativo");
        pixBox.classList.remove("d-none")
        boletoBox.classList.add("d-none")
        cartaoBox.classList.add("d-none")
        return;
      }
    });
  });
};

handleMetodoAtivo();

//mascaras
let input_card = document.getElementById("credit__card");
let input_cvv = document.getElementById("cvv");

let maskCard = {
  mask: "0000 0000 0000 0000",
};

let maskCvv = {
  mask: "000",
};

let card = IMask(input_card, maskCard);
let cvv = IMask(input_cvv, maskCvv);

//calcular valores

let mensal__essencial = document.querySelector("[data-essencial");
let taxa__essencial = document.querySelector("[data-taxa-essencial");

let mensal__transicao = document.querySelector("[data-transicao");
let taxa__transicao = document.querySelector("[data-taxa-transicao");

let mensal__amplo = document.querySelector("[data-amplo");
let taxa__amplo = document.querySelector("[data-taxa-amplo");

let taxa = document.querySelector("[data-taxa]");
let mensal = document.querySelector("[data-mensal]");
let total = document.querySelectorAll("[data-total]");

mensal__essencial.addEventListener("change", () => {
  handleCalculoEssencial();
});

const handleCalculoEssencial = () => {
  taxa.textContent = parseFloat(taxa__essencial.innerHTML).toLocaleString(
    "pt-br",
    { style: "currency", currency: "BRL" }
  );
  mensal.textContent = parseFloat(mensal__essencial.value).toLocaleString(
    "pt-br",
    { style: "currency", currency: "BRL" }
  );
  let valorTotal =
    parseFloat(taxa__essencial.innerHTML) + parseFloat(mensal__essencial.value);

    total.forEach(val =>{
      val.textContent = valorTotal.toLocaleString("pt-br", {
        style: "currency",
        currency: "BRL",
      });
    })

  return;
};


handleCalculoEssencial();

mensal__transicao.addEventListener("change", () => {
  handleCalculoTransicao();
});

const handleCalculoTransicao = () => {
  taxa.textContent = parseFloat(taxa__transicao.innerHTML).toLocaleString(
    "pt-br",
    { style: "currency", currency: "BRL" }
  );
  mensal.textContent = parseFloat(mensal__transicao.value).toLocaleString(
    "pt-br",
    { style: "currency", currency: "BRL" }
  );
  let valorTotal = parseFloat(taxa__transicao.innerHTML) + parseFloat(mensal__transicao.value);
  total.forEach(val =>{
    val.textContent = valorTotal.toLocaleString("pt-br", {
      style: "currency",
      currency: "BRL",
    });
  })
  return;
};

mensal__amplo.addEventListener("change", () => {
  handleCalculoAmplo();
});

const handleCalculoAmplo = () => {
  taxa.textContent = parseFloat(taxa__amplo.innerHTML).toLocaleString("pt-br", {
    style: "currency",
    currency: "BRL",
  });
  mensal.textContent = parseFloat(mensal__amplo.value).toLocaleString("pt-br", {
    style: "currency",
    currency: "BRL",
  });
  let valorTotal = parseFloat(taxa__amplo.innerHTML) + parseFloat(mensal__transicao.value);
  total.forEach(val =>{
    val.textContent = valorTotal.toLocaleString("pt-br", {
      style: "currency",
      currency: "BRL",
    });
  })
  return;
};



document.querySelector('#login-button').addEventListener('click', (elem) => {

    var ERemail = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/)

    var _form = document.querySelector('.modal__login form')
    var _email = document.querySelector('.modal__login #email')
    var _password = document.querySelector('.modal__login #password')

    var errors = false;
    var errorsMessage = []

    if(!ERemail.test(_email.value)) {

        errors = true
        errorsMessage.push('E-mail inválido, verifique-o')

    }

    if(_password.value.length < 6) {

        errors = true
        errorsMessage.push('Password inválido, mínimo 6 caracteres')

    }

    if(!errors) {

        _form.submit()

    }
    else {

        var finalMessage = ''

        for(var i = 0; i<errorsMessage.length; i++) {
            finalMessage += '- ' + errorsMessage[i] +'<br>'
        }

        document.querySelector('#login-errors').innerHTML = finalMessage
        document.querySelector('#login-errors').classList.add('active')

    }
})




