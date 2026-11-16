<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar conta — HotelReserva</title>
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
          <a href="login.php" class="btn btn-sm btn-outline btn-primary">Entrar</a>
        </div>
        <div class="navbar-end md:hidden"><a href="index.php" class="btn btn-ghost btn-sm">Buscar</a></div>
      </nav>
    </div>
  </header>
  <main id="conteudo-principal" class="container-hr">
    <div class="max-w-md mx-auto mt-4 md:mt-8">
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 md:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Criar conta</h1>
        <p class="text-gray-600 mb-6">Cadastre-se para reservar quartos e acompanhar suas reservas.</p>
        <form action="#" method="post" novalidate>
          <div class="form-control w-full mb-4">
            <label for="nome" class="label"><span class="label-text font-medium text-gray-700">Nome <span class="text-red-600">*</span></span></label>
            <input type="text" id="nome" name="nome" class="input input-bordered w-full bg-white text-gray-900" autocomplete="name" required />
          </div>
          <div class="form-control w-full mb-4">
            <label for="email" class="label"><span class="label-text font-medium text-gray-700">E-mail <span class="text-red-600">*</span></span></label>
            <input type="email" id="email" name="email" class="input input-bordered w-full bg-white text-gray-900" autocomplete="email" required />
          </div>
          <div class="form-control w-full mb-4">
            <label for="senha" class="label"><span class="label-text font-medium text-gray-700">Senha <span class="text-red-600">*</span></span></label>
            <input type="password" id="senha" name="senha" class="input input-bordered w-full bg-white text-gray-900" autocomplete="new-password" required />
          </div>
          <div class="form-control w-full mb-6">
            <label for="confirmar_senha" class="label"><span class="label-text font-medium text-gray-700">Confirmar senha <span class="text-red-600">*</span></span></label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" class="input input-bordered w-full bg-white text-gray-900" autocomplete="new-password" required />
          </div>
          <button type="submit" class="btn btn-primary w-full text-white">Cadastrar</button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-600">
          <p>Já tem conta? <a href="login.php" class="text-blue-600 hover:underline font-medium">Entrar</a></p>
        </div>
      </div>
    </div>
  </main>
  <footer class="mt-10 border-t border-gray-200 bg-white">
    <div class="container-hr py-6 text-center text-sm text-gray-500"><p>&copy; 2026 HotelReserva. Todos os direitos reservados.</p></div>
  </footer>
</body>
</html>