<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração de quartos — HotelReserva</title>
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
          <a href="quartos.php" class="text-blue-600 font-medium" aria-current="page">Quartos</a>
          <a href="reservas.php" class="text-gray-700 hover:text-blue-600">Reservas</a>
          <a href="../logout.php" class="btn btn-sm btn-outline btn-primary">Sair</a>
        </div>
        <div class="navbar-end md:hidden"><a href="index.php" class="btn btn-ghost btn-sm">Painel</a></div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Administração de quartos</h1>
      <a href="quarto-novo.php" class="btn btn-primary text-white w-full sm:w-auto">+ Novo quarto</a>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr class="bg-gray-50">
              <th class="text-gray-700">Nome</th>
              <th class="text-gray-700">Capacidade</th>
              <th class="text-gray-700">Preço/noite</th>
              <th class="text-gray-700">Qtd.</th>
              <th class="text-gray-700">Status</th>
              <th class="text-gray-700">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-medium text-gray-900">Quarto Standard</td>
              <td>2</td>
              <td>R$ 200,00</td>
              <td>3</td>
              <td><span class="badge badge-success text-white">Ativo</span></td>
              <td class="space-x-2">
                <button type="button" class="btn btn-xs btn-outline">Editar</button>
                <button type="button" class="btn btn-xs btn-outline btn-error">Desativar</button>
              </td>
            </tr>
            <tr>
              <td class="font-medium text-gray-900">Suíte Família</td>
              <td>4</td>
              <td>R$ 350,00</td>
              <td>1</td>
              <td><span class="badge badge-success text-white">Ativo</span></td>
              <td class="space-x-2">
                <button type="button" class="btn btn-xs btn-outline">Editar</button>
                <button type="button" class="btn btn-xs btn-outline btn-error">Desativar</button>
              </td>
            </tr>
            <tr class="opacity-70">
              <td class="font-medium text-gray-900">Quarto Econômico</td>
              <td>1</td>
              <td>R$ 120,00</td>
              <td>2</td>
              <td><span class="badge bg-gray-500 text-white border-gray-500">Inativo</span></td>
              <td class="space-x-2">
                <button type="button" class="btn btn-xs btn-outline">Editar</button>
                <button type="button" class="btn btn-xs btn-outline btn-success">Ativar</button>
              </td>
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