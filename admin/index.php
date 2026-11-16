<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do administrador — HotelReserva</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/flyonui@1.3.0/flyonui.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>
  <header class="bg-white border-b border-gray-200">
    <div class="container-hr">
      <nav class="navbar px-0 min-h-[64px]" aria-label="Navegação do administrador">
        <div class="navbar-start">
          <a href="../index.php" class="text-xl font-bold text-gray-900 no-underline" aria-label="HotelReserva - Ir para a página inicial"><span class="text-blue-600">Hotel</span>Reserva</a>
        </div>
        <div class="navbar-end gap-2 hidden md:flex items-center">
          <a href="index.php" class="text-blue-600 font-medium" aria-current="page">Painel</a>
          <a href="quartos.php" class="text-gray-700 hover:text-blue-600">Quartos</a>
          <a href="reservas.php" class="text-gray-700 hover:text-blue-600">Reservas</a>
          <a href="../logout.php" class="btn btn-sm btn-outline btn-primary">Sair</a>
        </div>
        <div class="navbar-end md:hidden">
          <div class="dropdown dropdown-end">
            <button type="button" tabindex="0" class="btn btn-ghost btn-sm">Menu</button>
            <ul tabindex="0" class="dropdown-content menu bg-white rounded-box z-[10] w-52 p-2 shadow-lg border border-gray-200 mt-2">
              <li><a href="index.php" aria-current="page">Painel</a></li>
              <li><a href="quartos.php">Quartos</a></li>
              <li><a href="reservas.php">Reservas</a></li>
              <li><a href="../logout.php">Sair</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Painel do administrador</h1>
    <p class="text-gray-600 mb-8">Gerencie quartos e reservas do sistema.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
      <a href="quartos.php" class="block bg-white rounded-lg border border-gray-200 shadow-sm p-6 hover:border-blue-500 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Gerenciar quartos</h2>
        <p class="text-gray-600 text-sm">Cadastre, edite e ative ou desative quartos disponíveis.</p>
      </a>
      <a href="reservas.php" class="block bg-white rounded-lg border border-gray-200 shadow-sm p-6 hover:border-blue-500 hover:shadow-md transition">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Gerenciar reservas</h2>
        <p class="text-gray-600 text-sm">Visualize todas as reservas e cancele quando necessário.</p>
      </a>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>