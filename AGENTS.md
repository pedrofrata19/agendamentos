# AGENTS.md — HotelReserva

Guia para desenvolvimento e manutenção do projeto por pessoas/agentes. Complementa o `PRODUCT.md` e o `PLANO.md`.

## 1. Tecnologias permitidas
- **Frontend:** HTML, CSS, JavaScript puro (sem frameworks obrigatórios).
- **Backend:** PHP puro (sem frameworks obrigatórios).
- **Banco de dados:** MySQL.
- **Acesso a dados:** PDO com **prepared statements** (obrigatório).
- **Autenticação/sessão:** sessão nativa do PHP (`$_SESSION`) e hashing com `password_hash` / `password_verify`.
- **Ambiente local:** XAMPP (Apache + MySQL) em Windows.

**Não utilizar no MVP (salvo decisão explícita documentada):**
- Frameworks PHP/JS, ORMs, gateways de pagamento, WebSockets, bibliotecas que adicionem complexidade desnecessária.
- Dependências externas não essenciais.

## 2. Convenções de código e organização
- **Estrutura:** seguir a organização proposta em `PLANO.md` (`includes/`, `admin/`, `assets/`, `config/`, `sql/`).
- **Idioma:** nomes de pastas/arquivos e identificadores podem seguir o padrão já adotado no projeto (português é aceitável); manter consistência.
- **Separação de responsabilidades (simples):**
  - `includes/db.php`: conexão PDO.
  - `includes/auth.php`: sessão e controle de acesso por perfil.
  - `includes/funcoes.php`: regras reutilizáveis (ex.: cálculo/consulta de disponibilidade, validações).
  - Páginas: apresentação + orquestração mínima, delegando lógica compartilhada aos includes.
- **Segurança e dados:**
  - Validar **toda** entrada no servidor (JS é apenas conveniência).
  - Usar **prepared statements** em todas as queries; nunca interpolar entrada do usuário em SQL.
  - Escapar toda saída em HTML com `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.
  - Armazenar senhas somente com `password_hash()`; verificar com `password_verify()`.
  - Usar `DATE` no MySQL e `DateTimeImmutable` (ou equivalente consistente) no PHP para datas.
- **Regras de negócio:**
  - Disponibilidade implementada uma única vez e reutilizada na busca (F2) e na criação de reserva (F3).
  - Revalidar disponibilidade no servidor no momento de criar a reserva; preferir transação para checagem + inserção.
  - Status de reserva no MVP: `confirmada` ou `cancelada`.
  - Quartos inativos não aparecem na busca e não recebem novas reservas.
- **Estilo:** código legível para iniciante (funções pequenas, nomes claros, comentários apenas quando necessário).

## 3. Cuidados com segredos e dados sensíveis
- **Nunca versionar credenciais reais:** usuário/senha do banco, chaves, tokens ou dados pessoais sensíveis.
- **Configuração local:** manter um arquivo de exemplo versionado (ex.: `config/config.exemplo.php`) e um arquivo real local (ex.: `config/config.php`) **fora do Git**.
- **.gitignore (recomendado):** ignorar arquivos de configuração real e artefatos locais, por exemplo:
  - `config/config.php`
  - `.env` / arquivos locais de ambiente
  - uploads temporários (se existirem no futuro)
- **Banco de dados:** não commitar dumps com dados reais/sensíveis; scripts em `sql/` devem conter apenas estrutura/dados de exemplo não sensíveis.
- **Senhas:** nunca registrar senhas em texto puro em código, logs, comentários ou commits.
- **Dados pessoais:** tratar nome/e-mail como dados pessoais; exibir apenas o necessário para cada perfil.

## 4. Procedimento de testes (manual, MVP)
Executar em ambiente local (XAMPP) com banco criado a partir de `sql/schema.sql`.

### 4.1 Preparação
- [ ] Apache e MySQL em execução; aplicação acessível em `http://localhost/controle/`.
- [ ] Banco criado e tabelas carregadas sem erro.
- [ ] Existe ao menos 1 usuário **admin** e 1 usuário **viajante** para testes.
- [ ] Existe ao menos 1 quarto ativo cadastrado (para testar busca/reserva).

### 4.2 Autenticação e acesso (F1)
- [ ] Cadastro com e-mail novo funciona; cadastro com e-mail existente é recusado com mensagem clara.
- [ ] Login correto redireciona conforme perfil; senha incorreta não autentica.
- [ ] Acesso direto a `minhas-reservas.php` e `admin/*` sem sessão redireciona para login.
- [ ] Viajante não acessa `admin/*`; logout invalida o acesso às áreas restritas.

### 4.3 Quartos (F5 — parte de cadastro)
- [ ] Admin cria, edita e desativa quarto; alterações refletem na listagem/admin.
- [ ] Quarto inativo não aparece na busca e não pode ser reservado.

### 4.4 Busca e disponibilidade (F2)
- [ ] Datas inválidas (checkout ≤ checkin, data passada) mostram erro e não retornam resultados indevidos.
- [ ] Busca lista apenas quartos ativos com capacidade suficiente.
- [ ] Quartos com unidades esgotadas no período aparecem como "Esgotado no período"; sem resultados exibe "Nenhum quarto encontrado".

### 4.5 Reserva (F3)
- [ ] Usuário não logado é levado ao login ao tentar reservar.
- [ ] Tela de reserva mostra datas e valor total correto.
- [ ] Reserva bem-sucedida é gravada como `confirmada` e reduz disponibilidade no período.
- [ ] Se o quarto esgotar antes da confirmação, a criação é recusada com mensagem clara (revalidação no servidor).

### 4.6 Minhas reservas e cancelamento (F4 / F5)
- [ ] Viajante vê apenas suas reservas; cancelamento altera status para `cancelada` e libera disponibilidade.
- [ ] Viajante não cancela reserva de outro usuário nem reserva já cancelada.
- [ ] Admin lista todas as reservas e consegue cancelar, liberando o período.

### 4.7 Verificações técnicas básicas
- [ ] Nenhuma query usa concatenação de entrada do usuário (prepared statements em uso).
- [ ] Saídas exibidas na interface estão escapadas (`htmlspecialchars`).
- [ ] Senhas no banco estão como hash (não texto puro).

## 5. Fora de escopo nesta etapa
- Não implementar funcionalidades do MVP nem itens listados como futuros no `PRODUCT.md` enquanto o objetivo for apenas documentação/planejamento.
- Alterações de escopo devem ser registradas no `PRODUCT.md`/`PLANO.md` antes da implementação.
