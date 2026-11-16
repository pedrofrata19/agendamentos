<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmar reserva — HotelReserva</title>
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
          <a href="index.php" class="text-gray-700 hover:text-blue-600">Buscar</a>
          <a href="minhas-reservas.php" class="text-gray-700 hover:text-blue-600">Minhas reservas</a>
          <a href="logout.php" class="btn btn-sm btn-outline btn-primary">Sair</a>
        </div>
        <div class="navbar-end md:hidden"><a href="minhas-reservas.php" class="btn btn-ghost btn-sm">Reservas</a></div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <div class="max-w-2xl mx-auto mt-4 md:mt-8">
      <a href="index.php" class="text-blue-600 hover:underline text-sm mb-4 inline-block">&larr; Voltar para busca</a>
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 md:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Confirmar reserva</h1>
        <div class="space-y-4 text-gray-700">
          <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
            <h2 class="font-semibold text-gray-900 text-lg">Quarto Deluxe</h2>
            <p class="text-sm text-gray-600 mt-1">Cama queen, acabamento moderno, bancada de trabalho e café da manhã incluso.</p>
          </div>
          <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><dt class="text-sm text-gray-500">Check-in</dt><dd class="font-medium text-gray-900">10/08/2026</dd></div>
            <div><dt class="text-sm text-gray-500">Check-out</dt><dd class="font-medium text-gray-900">12/08/2026</dd></div>
            <div><dt class="text-sm text-gray-500">Hóspedes</dt><dd class="font-medium text-gray-900">2</dd></div>
            <div><dt class="text-sm text-gray-500">Noites</dt><dd class="font-medium text-gray-900">2</dd></div>
          </dl>
          <div class="pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500">Valor total</p>
            <p class="text-3xl font-bold text-gray-900">R$ 560,00</p>
            <p class="text-sm text-gray-500 mt-1">R$ 280,00 por noite</p>
          </div>
        </div>
        <div class="mt-8 flex flex-col sm:flex-row gap-3">
          <form action="minhas-reservas.php" method="get" class="flex-1">
            <button type="submit" class="btn btn-primary w-full text-white">Confirmar reserva</button>
          </form>
          <a href="index.php" class="btn btn-outline w-full sm:w-auto">Voltar</a>
        </div>
      </div>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>