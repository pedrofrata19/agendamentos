<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minhas reservas — HotelReserva</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/flyonui@1.3.0/flyonui.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>
  <header class="bg-white border-b border-gray-200">
    <div class="container-hr">
      <nav class="navbar px-0 min-h-[64px]" aria-label="Navegação principal">
        <div class="navbar-start">
          <a href="index.php" class="text-xl font-bold text-gray-900 no-underline" aria-label="HotelReserva - Ir para a página inicial"><span class="text-blue-600">Hotel</span>Reserva</a>
        </div>
        <div class="navbar-end gap-2 hidden md:flex items-center">
          <span class="text-sm text-gray-600">Olá, Maria</span>
          <a href="index.php" class="text-gray-700 hover:text-blue-600">Buscar</a>
          <a href="minhas-reservas.php" class="text-blue-600 font-medium" aria-current="page">Minhas reservas</a>
          <a href="logout.php" class="btn btn-sm btn-outline btn-primary">Sair</a>
        </div>
        <div class="navbar-end md:hidden">
          <div class="dropdown dropdown-end">
            <button type="button" tabindex="0" class="btn btn-ghost btn-sm">Menu</button>
            <ul tabindex="0" class="dropdown-content menu bg-white rounded-box z-[10] w-52 p-2 shadow-lg border border-gray-200 mt-2">
              <li><a href="index.php">Buscar</a></li>
              <li><a href="minhas-reservas.php" aria-current="page">Minhas reservas</a></li>
              <li><a href="logout.php">Sair</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Minhas reservas</h1>
        <p class="text-gray-600 mt-1">Acompanhe e gerencie suas reservas.</p>
      </div>
      <a href="index.php" class="btn btn-primary text-white w-full sm:w-auto">Nova busca</a>
    </div>
    <div class="space-y-4">
      <article class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 md:p-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 flex-wrap mb-2">
              <h2 class="text-lg font-semibold text-gray-900">Quarto Deluxe</h2>
              <span class="badge badge-success text-white">Confirmada</span>
            </div>
            <p class="text-sm text-gray-600">10/08/2026 a 12/08/2026 (2 noites) • 2 hóspedes</p>
            <p class="text-lg font-bold text-gray-900 mt-2">R$ 560,00</p>
          </div>
          <div class="flex-shrink-0">
            <button type="button" class="btn btn-outline btn-error btn-sm w-full md:w-auto" onclick="alert('Protótipo: confirmação de cancelamento.');">Cancelar reserva</button>
          </div>
        </div>
      </article>
      <article class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 md:p-6 opacity-75">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 flex-wrap mb-2">
              <h2 class="text-lg font-semibold text-gray-900">Quarto Standard</h2>
              <span class="badge bg-gray-500 text-white border-gray-500">Cancelada</span>
            </div>
            <p class="text-sm text-gray-600">01/07/2026 a 03/07/2026 (2 noites) • 1 hóspede</p>
            <p class="text-lg font-bold text-gray-900 mt-2">R$ 400,00</p>
          </div>
        </div>
      </article>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>