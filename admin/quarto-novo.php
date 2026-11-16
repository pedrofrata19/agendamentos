<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo quarto — HotelReserva (Admin)</title>
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
        <div class="navbar-end md:hidden"><a href="quartos.php" class="btn btn-ghost btn-sm">Quartos</a></div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <div class="max-w-3xl mx-auto">
      <a href="quartos.php" class="text-blue-600 hover:underline text-sm mb-4 inline-block">&larr; Voltar para quartos</a>
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 md:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Novo quarto</h1>
        <p class="text-gray-600 mb-6">Preencha os dados do quarto. (Visual apenas — sem salvamento.)</p>
        <form action="quartos.php" method="get" novalidate>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div class="form-control w-full md:col-span-2">
              <label for="nome" class="label"><span class="label-text font-medium text-gray-700">Nome do quarto <span class="text-red-600">*</span></span></label>
              <input type="text" id="nome" name="nome" class="input input-bordered w-full bg-white text-gray-900" placeholder="Ex.: Quarto Deluxe" required />
            </div>
            <div class="form-control w-full md:col-span-2">
              <label for="descricao" class="label"><span class="label-text font-medium text-gray-700">Descrição</span></label>
              <textarea id="descricao" name="descricao" class="textarea textarea-bordered w-full bg-white text-gray-900" rows="3" placeholder="Breve descrição do quarto, comodidades, etc."></textarea>
            </div>
            <div class="form-control w-full">
              <label for="capacidade" class="label"><span class="label-text font-medium text-gray-700">Capacidade (hóspedes) <span class="text-red-600">*</span></span></label>
              <input type="number" id="capacidade" name="capacidade" class="input input-bordered w-full bg-white text-gray-900" min="1" value="2" required />
            </div>
            <div class="form-control w-full">
              <label for="preco" class="label"><span class="label-text font-medium text-gray-700">Preço por noite (R$) <span class="text-red-600">*</span></span></label>
              <input type="number" id="preco" name="preco" class="input input-bordered w-full bg-white text-gray-900" min="0" step="0.01" placeholder="200.00" required />
            </div>
            <div class="form-control w-full">
              <label for="quantidade" class="label"><span class="label-text font-medium text-gray-700">Quantidade de unidades <span class="text-red-600">*</span></span></label>
              <input type="number" id="quantidade" name="quantidade" class="input input-bordered w-full bg-white text-gray-900" min="1" value="1" required />
            </div>
            <div class="form-control w-full">
              <label for="imagem" class="label"><span class="label-text font-medium text-gray-700">Imagem do quarto</span></label>
              <input type="file" id="imagem" name="imagem" class="file-input file-input-bordered w-full bg-white" accept="image/*" />
              <label class="label"><span class="label-text-alt text-gray-500">JPG, PNG ou WebP (visual apenas).</span></label>
            </div>
            <div class="form-control w-full md:col-span-2">
              <label class="label cursor-pointer justify-start gap-3">
                <input type="checkbox" name="ativo" class="checkbox checkbox-primary" checked />
                <span class="label-text font-medium text-gray-700">Quarto ativo (disponível para reserva)</span>
              </label>
            </div>
          </div>
          <div class="mt-8 flex flex-col sm:flex-row gap-3">
            <button type="submit" class="btn btn-primary text-white">Salvar quarto</button>
            <a href="quartos.php" class="btn btn-outline">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>