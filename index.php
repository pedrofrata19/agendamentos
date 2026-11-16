<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HotelReserva — Buscar quartos</title>
  <!-- Tailwind CSS + FlyonUI (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/flyonui@1.3.0/flyonui.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

  <!-- Header -->
  <header class="bg-white border-b border-gray-200">
    <div class="container-hr">
      <nav class="navbar px-0 min-h-[64px]" aria-label="Navegação principal">
        <div class="navbar-start">
          <a href="index.php" class="text-xl font-bold text-gray-900 no-underline" aria-label="HotelReserva - Ir para a página inicial">
            <span class="text-blue-600">Hotel</span>Reserva
          </a>
        </div>
        <div class="navbar-end gap-2">
          <!-- Desktop links -->
          <div class="hidden md:flex items-center gap-4">
            <a href="index.php" class="text-blue-600 font-medium" aria-current="page">Buscar</a>
            <a href="login.php" class="btn btn-sm btn-outline btn-primary">Entrar</a>
            <a href="cadastro.php" class="btn btn-sm btn-primary text-white">Criar conta</a>
          </div>
          <!-- Mobile menu -->
          <div class="dropdown dropdown-end md:hidden">
            <button type="button" tabindex="0" class="btn btn-ghost btn-square" aria-label="Abrir menu" aria-expanded="false" id="btnMenuMobile">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
            <ul tabindex="0" class="dropdown-content menu bg-white rounded-box z-[10] w-56 p-2 shadow-lg border border-gray-200 mt-2">
              <li><a href="index.php" aria-current="page">Buscar</a></li>
              <li><a href="login.php">Entrar</a></li>
              <li><a href="cadastro.php">Criar conta</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <main id="conteudo-principal" class="container-hr">
    <!-- Alerts area -->
    <div class="mb-4 space-y-2" aria-live="polite" aria-atomic="true">
      <div class="alert alert-warning shadow-sm" role="alert" id="alert-demo" style="display:none;">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <span id="alert-demo-text">Mensagem de alerta.</span>
      </div>
    </div>

    <!-- Page title -->
    <section class="mb-6">
      <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Buscar quartos</h1>
      <p class="mt-2 text-gray-600">Informe as datas e o número de hóspedes para ver os quartos disponíveis.</p>
    </section>

    <!-- Search form -->
    <section class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 md:p-6 mb-8" aria-labelledby="titulo-busca">
      <h2 id="titulo-busca" class="sr-only">Formulário de busca de quartos</h2>
      <form id="form-busca" action="#" method="get" novalidate>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 items-end">
          <div class="form-control w-full">
            <label for="checkin" class="label">
              <span class="label-text font-medium text-gray-700">Check-in <span class="text-red-600" aria-hidden="true">*</span></span>
            </label>
            <input type="date" id="checkin" name="checkin" class="input input-bordered w-full bg-white text-gray-900" required autocomplete="off" aria-describedby="help-checkin" />
            <label class="label hidden" id="help-checkin"><span class="label-text-alt text-red-600" id="err-checkin"></span></label>
          </div>
          <div class="form-control w-full">
            <label for="checkout" class="label">
              <span class="label-text font-medium text-gray-700">Check-out <span class="text-red-600" aria-hidden="true">*</span></span>
            </label>
            <input type="date" id="checkout" name="checkout" class="input input-bordered w-full bg-white text-gray-900" required autocomplete="off" aria-describedby="help-checkout" />
            <label class="label hidden" id="help-checkout"><span class="label-text-alt text-red-600" id="err-checkout"></span></label>
          </div>
          <div class="form-control w-full">
            <label for="hospedes" class="label">
              <span class="label-text font-medium text-gray-700">Nº de hóspedes <span class="text-red-600" aria-hidden="true">*</span></span>
            </label>
            <input type="number" id="hospedes" name="hospedes" class="input input-bordered w-full bg-white text-gray-900" min="1" value="2" required autocomplete="off" aria-describedby="help-hospedes" />
            <label class="label hidden" id="help-hospedes"><span class="label-text-alt text-red-600" id="err-hospedes"></span></label>
          </div>
          <div class="form-control w-full">
            <button type="submit" id="btn-buscar" class="btn btn-primary w-full text-white">
              <span id="btn-buscar-text">Buscar</span>
            </button>
          </div>
        </div>
      </form>
    </section>

    <!-- Results area -->
    <section aria-labelledby="titulo-resultados">
      <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
        <h2 id="titulo-resultados" class="text-xl font-semibold text-gray-900">Resultados</h2>
        <p class="text-sm text-gray-500" id="info-resultados">Exibindo opções fictícias para demonstração.</p>
      </div>

      <div id="estado-carregando" class="hidden">
        <div class="flex items-center gap-3 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-800" role="status" aria-live="polite">
          <span class="loading loading-spinner loading-md" aria-hidden="true"></span>
          <span>Buscando disponibilidade...</span>
        </div>
      </div>

      <div id="estado-vazio" class="hidden">
        <div class="alert alert-info">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span>Nenhum quarto encontrado para os critérios informados.</span>
        </div>
      </div>

      <div id="lista-resultados" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Card 1 -->
        <article class="card bg-white border border-gray-200 shadow-sm">
          <figure class="h-44 overflow-hidden bg-gray-200">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80" alt="Quarto Standard com cama de casal e decoração aconchegante" class="w-full h-full object-cover" loading="lazy" />
          </figure>
          <div class="card-body p-4 md:p-5">
            <h3 class="card-title text-lg text-gray-900">Quarto Standard</h3>
            <p class="text-sm text-gray-600">Aconchegante, cama de casal, ar-condicionado e Wi-Fi. Ideal para viagens a dois.</p>
            <div class="mt-2 space-y-1 text-sm text-gray-700">
              <p><span class="font-medium">Capacidade:</span> 2 hóspedes</p>
              <p><span class="font-medium">Preço:</span> R$ 200,00 / noite</p>
            </div>
            <div class="mt-3">
              <span class="badge badge-success gap-1 text-white">
                <span aria-hidden="true">●</span> Disponível
              </span>
            </div>
            <div class="card-actions mt-4">
              <a href="reserva.php?quarto=1&checkin=&checkout=&hospedes=2" class="btn btn-primary btn-sm w-full text-white" id="btn-reservar-1">Reservar</a>
            </div>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="card bg-white border border-gray-200 shadow-sm">
          <figure class="h-44 overflow-hidden bg-gray-200">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80" alt="Suíte Família com espaço amplo e camas para família" class="w-full h-full object-cover" loading="lazy" />
          </figure>
          <div class="card-body p-4 md:p-5">
            <h3 class="card-title text-lg text-gray-900">Suíte Família</h3>
            <p class="text-sm text-gray-600">Espaço amplo, duas camas, sala de estar e vista interna. Conforto para toda a família.</p>
            <div class="mt-2 space-y-1 text-sm text-gray-700">
              <p><span class="font-medium">Capacidade:</span> 4 hóspedes</p>
              <p><span class="font-medium">Preço:</span> R$ 350,00 / noite</p>
            </div>
            <div class="mt-3">
              <span class="badge badge-error gap-1 text-white">
                <span aria-hidden="true">○</span> Esgotado no período
              </span>
            </div>
            <div class="card-actions mt-4">
              <button type="button" class="btn btn-sm w-full font-semibold cursor-not-allowed" disabled aria-disabled="true" title="Indisponível para o período selecionado" style="background-color:#374151 !important; color:#ffffff !important; border:2px solid #374151 !important; opacity:1 !important;">
                Reservar (indisponível)
              </button>
            </div>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="card bg-white border border-gray-200 shadow-sm">
          <figure class="h-44 overflow-hidden bg-gray-200">
            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80" alt="Quarto Deluxe com cama queen e acabamento moderno" class="w-full h-full object-cover" loading="lazy" />
          </figure>
          <div class="card-body p-4 md:p-5">
            <h3 class="card-title text-lg text-gray-900">Quarto Deluxe</h3>
            <p class="text-sm text-gray-600">Cama queen, acabamento moderno, bancada de trabalho e café da manhã incluso.</p>
            <div class="mt-2 space-y-1 text-sm text-gray-700">
              <p><span class="font-medium">Capacidade:</span> 2 hóspedes</p>
              <p><span class="font-medium">Preço:</span> R$ 280,00 / noite</p>
            </div>
            <div class="mt-3">
              <span class="badge badge-success gap-1 text-white">
                <span aria-hidden="true">●</span> Disponível
              </span>
            </div>
            <div class="card-actions mt-4">
              <a href="reserva.php?quarto=3&checkin=&checkout=&hospedes=2" class="btn btn-primary btn-sm w-full text-white" id="btn-reservar-3">Reservar</a>
            </div>
          </div>
        </article>
      </div>
    </section>
  </main>

  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500">
      <p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p>
    </div>
  </footer>
</body>
</html>