<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração de reservas — HotelReserva</title>
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
        <div class="navbar-start"><a href="../index.php" class="text-xl font-bold text-gray-900 no-underline"><span class="text-blue-600">Hotel</span>Reserva</a></div>
        <div class="navbar-end gap-2 hidden md:flex items-center">
          <a href="index.php" class="text-gray-700 hover:text-blue-600">Painel</a>
          <a href="quartos.php" class="text-gray-700 hover:text-blue-600">Quartos</a>
          <a href="reservas.php" class="text-blue-600 font-medium" aria-current="page">Reservas</a>
          <a href="../logout.php" class="btn btn-sm btn-outline btn-primary">Sair</a>
        </div>
        <div class="navbar-end md:hidden"><a href="index.php" class="btn btn-ghost btn-sm">Painel</a></div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Administração de reservas</h1>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr class="bg-gray-50">
              <th class="text-gray-700">Viajante</th>
              <th class="text-gray-700">Quarto</th>
              <th class="text-gray-700">Período</th>
              <th class="text-gray-700">Valor</th>
              <th class="text-gray-700">Status</th>
              <th class="text-gray-700">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="font-medium text-gray-900">Maria Silva</div>
                <div class="text-sm text-gray-500">maria@exemplo.com</div>
              </td>
              <td>Quarto Deluxe</td>
              <td>10/08/2026 – 12/08/2026</td>
              <td>R$ 560,00</td>
              <td><span class="badge badge-success text-white">Confirmada</span></td>
              <td><button type="button" class="btn btn-xs btn-outline btn-error" onclick="alert('Protótipo: confirmar cancelamento.');">Cancelar</button></td>
            </tr>
            <tr>
              <td>
                <div class="font-medium text-gray-900">João Santos</div>
                <div class="text-sm text-gray-500">joao@exemplo.com</div>
              </td>
              <td>Quarto Standard</td>
              <td>15/08/2026 – 17/08/2026</td>
              <td>R$ 400,00</td>
              <td><span class="badge badge-success text-white">Confirmada</span></td>
              <td><button type="button" class="btn btn-xs btn-outline btn-error" onclick="alert('Protótipo: confirmar cancelamento.');">Cancelar</button></td>
            </tr>
            <tr class="opacity-70">
              <td>
                <div class="font-medium text-gray-900">Ana Costa</div>
                <div class="text-sm text-gray-500">ana@exemplo.com</div>
              </td>
              <td>Suíte Família</td>
              <td>01/07/2026 – 05/07/2026</td>
              <td>R$ 1.400,00</td>
              <td><span class="badge bg-gray-500 text-white border-gray-500">Cancelada</span></td>
              <td><span class="text-sm text-gray-400">—</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>