# NAVEGACAO.md — HotelReserva (MVP)

Documento de navegação do MVP. Baseado em `PRODUCT.md` e `PLANO.md`.

## 1. Visão geral das telas

| ID | Tela | Arquivo (sugerido) | Perfil | Acesso |
|---|---|---|---|---|
| T01 | Início / Busca | `index.php` | Público | Livre |
| T02 | Login | `login.php` | Público | Livre (redireciona se já logado) |
| T03 | Cadastro | `cadastro.php` | Público | Livre (redireciona se já logado) |
| T04 | Confirmação de reserva | `reserva.php` | Viajante | Requer sessão (perfil viajante) |
| T05 | Minhas reservas | `minhas-reservas.php` | Viajante | Requer sessão (perfil viajante) |
| T06 | Painel do administrador | `admin/index.php` | Admin | Requer sessão (perfil admin) |
| T07 | Administração de quartos | `admin/quartos.php` | Admin | Requer sessão (perfil admin) |
| T08 | Administração de reservas | `admin/reservas.php` | Admin | Requer sessão (perfil admin) |

**Ação global (sem tela dedicada):** `logout.php` encerra a sessão e redireciona para `index.php` (ou `login.php`).

## 2. Fluxo principal de navegação

### 2.1 Viajante (fluxo completo)

```text
[T01 Início/Busca]
   ├─ (menu) Entrar ───────────────> [T02 Login]
   │                                    ├─ sucesso viajante -> [T01] ou página de retorno
   │                                    ├─ sucesso admin -> [T06]
   │                                    └─ "Criar conta" -> [T03 Cadastro]
   ├─ (menu) Criar conta ──────────> [T03 Cadastro] -> sucesso -> [T02] ou login automático -> [T01]
   ├─ preencher busca e enviar ────> [T01 com resultados]
   │                                    └─ "Reservar" (quarto disponível)
   │                                          ├─ sem sessão -> [T02] (com retorno para T04)
   │                                          └─ com sessão viajante -> [T04 Confirmação]
   └─ (menu, logado) Minhas reservas -> [T05 Minhas reservas]

[T04 Confirmação de reserva]
   ├─ "Confirmar reserva" (sucesso) -> [T05 Minhas reservas] (mensagem de sucesso)
   ├─ "Confirmar reserva" (esgotou/erro) -> permanece em [T04] com mensagem de erro
   └─ "Voltar" -> [T01 com critérios de busca preservados, se possível]

[T05 Minhas reservas]
   ├─ "Cancelar" (reserva confirmada) -> confirmação -> [T05] atualizada (sucesso/erro)
   └─ "Nova busca" -> [T01]

Qualquer tela restrita sem sessão -> [T02]
Logout -> encerra sessão -> [T01]
```

### 2.2 Administrador

```text
[T02 Login] (admin) -> [T06 Painel]
[T06 Painel]
   ├─ "Gerenciar quartos" -> [T07 Administração de quartos]
   └─ "Gerenciar reservas" -> [T08 Administração de reservas]

[T07 Quartos]
   ├─ "Novo quarto" -> formulário (mesma tela ou seção) -> salvar -> [T07] com sucesso
   ├─ "Editar" -> formulário preenchido -> salvar -> [T07] com sucesso
   └─ "Ativar/Desativar" -> ação -> [T07] atualizada

[T08 Reservas]
   └─ "Cancelar" -> confirmação -> [T08] atualizada (sucesso/erro)

Acesso de viajante a admin/* -> bloqueio/redirecionamento (ex.: [T01] com erro de acesso)
```

## 3. Navegação global (header/menu)

- **Sempre visível:** logo/nome "HotelReserva" (link para `index.php`), link "Buscar".
- **Visitante (sem sessão):** "Entrar", "Criar conta".
- **Viajante logado:** saudação curta ("Olá, Nome"), "Minhas reservas", "Sair".
- **Admin logado:** "Painel", "Quartos", "Reservas", "Sair".
- **Comportamento responsivo:** em celular, menu colapsa em botão (hambúrguer) ou lista empilhada simples; em computador, links em linha no topo.

## 4. Detalhamento por tela

### T01 — Início / Busca (`index.php`)

**Objetivo:** permitir busca de disponibilidade e apresentar resultados (F2).

**Campos (formulário de busca):**
- Check-in (`date`, obrigatório).
- Check-out (`date`, obrigatório).
- Nº de hóspedes (`number`, mínimo 1, obrigatório).

**Botões/ações:**
- "Buscar" (submit).
- Em cada quarto disponível no resultado: "Reservar".
- Em quarto esgotado: ação de reservar desabilitada/oculta com rótulo "Esgotado no período".

**Mensagens:**
- Validação: "Informe a data de check-in.", "Informe a data de check-out.", "O check-out deve ser posterior ao check-in.", "A data de check-in não pode ser no passado.", "Informe o número de hóspedes."
- Lista vazia: "Nenhum quarto encontrado para os critérios informados."
- Erro geral: "Não foi possível realizar a busca. Tente novamente."

**Estados:**
- **Carregamento:** ao enviar busca, desabilitar botão "Buscar", exibir texto/indicador "Buscando disponibilidade..." na área de resultados.
- **Inicial (sem busca):** exibir apenas o formulário e uma breve instrução ("Informe as datas e o número de hóspedes para ver os quartos disponíveis.").
- **Lista vazia:** área de resultados com mensagem de vazio (após busca válida sem correspondência).
- **Sucesso (com resultados):** lista/cartões de quartos com nome, descrição, capacidade, preço/noite e status (Disponível/Esgotado).
- **Erro:** alerta visível próximo ao formulário ou à área de resultados, mantendo os valores informados nos campos.

---

### T02 — Login (`login.php`)

**Objetivo:** autenticar usuário (F1).

**Campos:**
- E-mail (`email`, obrigatório).
- Senha (`password`, obrigatório).

**Botões/ações:**
- "Entrar" (submit).
- Link "Criar conta" → T03.
- Link "Voltar para a busca" → T01.

**Mensagens:**
- Validação: "Informe seu e-mail.", "Informe sua senha."
- Erro de autenticação: "E-mail ou senha inválidos." (mensagem genérica, sem indicar qual campo falhou).
- Acesso restrito: "Faça login para continuar." (quando redirecionado de página protegida).

**Estados:**
- **Carregamento:** desabilitar "Entrar" e exibir "Entrando..." durante envio.
- **Sucesso:** redirecionamento conforme perfil (viajante: destino pretendido ou T01/T05; admin: T06). Não exibir tela persistente de sucesso.
- **Erro:** alerta de erro acima do formulário; preservar e-mail preenchido (não preservar senha).

---

### T03 — Cadastro (`cadastro.php`)

**Objetivo:** criar conta de viajante (F1).

**Campos:**
- Nome (`text`, obrigatório).
- E-mail (`email`, obrigatório).
- Senha (`password`, obrigatório).
- Confirmar senha (`password`, obrigatório).

**Botões/ações:**
- "Cadastrar" (submit).
- Link "Já tenho conta" → T02.

**Mensagens:**
- Validação: "Informe seu nome.", "Informe um e-mail válido.", "Informe uma senha.", "As senhas não coincidem."
- E-mail duplicado: "Este e-mail já está cadastrado."
- Sucesso: "Cadastro realizado com sucesso. Faça login para continuar." (ou autenticar automaticamente, conforme implementação definida).
- Erro geral: "Não foi possível concluir o cadastro. Tente novamente."

**Estados:**
- **Carregamento:** desabilitar "Cadastrar" e exibir "Cadastrando...".
- **Sucesso:** mensagem de sucesso e/ou redirecionamento para T02.
- **Erro:** alerta com mensagem específica (duplicidade/validação) ou geral; preservar nome e e-mail.

---

### T04 — Confirmação de reserva (`reserva.php`)

**Objetivo:** revisar dados e confirmar reserva (F3). Exige viajante autenticado.

**Campos (exibição e/ou hidden para submissão):**
- Quarto selecionado (nome, descrição, capacidade, preço/noite) — somente leitura.
- Check-in e check-out — somente leitura (vindos da busca).
- Nº de hóspedes — somente leitura.
- Quantidade de noites e valor total — calculados e exibidos.

**Botões/ações:**
- "Confirmar reserva" (submit).
- "Voltar" (retorna à busca/resultados).

**Mensagens:**
- Confirmação de sucesso: "Reserva confirmada com sucesso." (exibida em T05 após redirecionamento).
- Indisponibilidade (revalidação): "Este quarto não está mais disponível para o período selecionado."
- Dados inválidos/quarto inativo: "Não foi possível criar a reserva. Verifique as datas e o quarto selecionado."
- Erro geral: "Não foi possível concluir a reserva. Tente novamente."

**Estados:**
- **Carregamento (inicial):** "Carregando dados da reserva..." se dados vierem por parâmetro/consulta.
- **Carregamento (envio):** desabilitar "Confirmar reserva" e exibir "Confirmando...".
- **Sucesso:** gravação `confirmada` e redirecionamento para T05.
- **Erro:** alerta na própria tela; manter resumo visível para o usuário decidir voltar/nova busca.
- **Estado inválido (sem parâmetros/quarto inexistente):** mensagem "Reserva inválida." com ação para voltar à busca (não tratar como lista vazia).

---

### T05 — Minhas reservas (`minhas-reservas.php`)

**Objetivo:** listar reservas do viajante e permitir cancelamento (F4).

**Campos:** não há formulário de cadastro; ações por item.

**Botões/ações:**
- Em reserva `confirmada`: "Cancelar reserva".
- Confirmação de cancelamento: "Sim, cancelar" / "Não, voltar" (modal simples, `confirm()` ou bloco inline).
- "Nova busca" → T01.

**Informações por reserva:**
- Quarto, check-in, check-out, nº de hóspedes (se armazenado/exibido), valor total, status (`confirmada`/`cancelada`).

**Mensagens:**
- Lista vazia: "Você ainda não possui reservas." com ação "Buscar quartos".
- Sucesso cancelamento: "Reserva cancelada com sucesso."
- Erro cancelamento: "Não foi possível cancelar a reserva." ou "Esta reserva não pode ser cancelada."
- Erro de carregamento: "Não foi possível carregar suas reservas. Tente novamente."

**Estados:**
- **Carregamento:** "Carregando suas reservas..." (skeleton/lista provisória ou texto).
- **Lista vazia:** estado vazio com mensagem e CTA para busca.
- **Sucesso (listagem):** lista/cartões; reservas `canceladas` visualmente distintas (ex.: badge cinza/riscado leve) das `confirmadas`.
- **Sucesso (ação):** alerta de sucesso após cancelamento e lista atualizada.
- **Erro:** alerta de erro; manter reservas já carregadas visíveis quando possível.

---

### T06 — Painel do administrador (`admin/index.php`)

**Objetivo:** ponto de entrada do admin (F5).

**Campos:** nenhum.

**Botões/ações:**
- "Gerenciar quartos" → T07.
- "Gerenciar reservas" → T08.

**Mensagens:**
- Boas-vindas: "Painel do administrador".
- Opcional (informativo): contagens simples (ex.: quartos ativos, reservas confirmadas) se já disponíveis; não obrigatório no MVP.

**Estados:**
- **Carregamento:** "Carregando painel..." (se houver contagens).
- **Sucesso:** exibição dos atalhos/cards de navegação.
- **Lista vazia:** não se aplica como lista principal; se contagens forem zero, exibir "0" normalmente.
- **Erro:** "Não foi possível carregar informações do painel." mantendo atalhos de navegação visíveis.

---

### T07 — Administração de quartos (`admin/quartos.php`)

**Objetivo:** listar, criar, editar e ativar/desativar quartos (F5).

**Campos (formulário criar/editar):**
- Nome (`text`, obrigatório).
- Descrição (`textarea`, opcional ou obrigatório conforme definição).
- Capacidade (`number`, mínimo 1, obrigatório).
- Preço por noite (`number/decimal`, > 0, obrigatório).
- Quantidade de unidades (`number`, mínimo 1, obrigatório).
- Ativo (`checkbox`/select, padrão ativo ao criar).

**Botões/ações:**
- "Novo quarto".
- "Salvar" / "Criar" (submit do formulário).
- "Cancelar edição".
- Por quarto: "Editar", "Desativar"/"Ativar".

**Mensagens:**
- Lista vazia: "Nenhum quarto cadastrado."
- Validação: "Informe o nome do quarto.", "Capacidade deve ser maior que zero.", "Preço deve ser maior que zero.", "Quantidade deve ser maior que zero."
- Sucesso: "Quarto criado com sucesso.", "Quarto atualizado com sucesso.", "Quarto desativado/ativado com sucesso."
- Erro: "Não foi possível salvar o quarto." / "Não foi possível alterar o status do quarto."

**Estados:**
- **Carregamento:** "Carregando quartos..."; no envio, "Salvando...".
- **Lista vazia:** mensagem de vazio com CTA "Novo quarto".
- **Sucesso:** lista atualizada; formulário limpo/fechado após criar ou salvar.
- **Erro:** alerta com detalhes de validação; preservar dados preenchidos no formulário.

---

### T08 — Administração de reservas (`admin/reservas.php`)

**Objetivo:** listar todas as reservas e cancelar quando necessário (F5).

**Campos:** sem formulário de criação; ação por item.

**Botões/ações:**
- Por reserva `confirmada`: "Cancelar reserva" (com confirmação).
- Filtros opcionais (não obrigatórios no MVP): por status/data — se ausentes, listar todas.

**Informações por reserva:**
- Viajante (nome/e-mail conforme necessário), quarto, check-in, check-out, valor, status.

**Mensagens:**
- Lista vazia: "Nenhuma reserva encontrada."
- Sucesso: "Reserva cancelada com sucesso."
- Erro: "Não foi possível cancelar a reserva." / "Esta reserva já está cancelada."
- Erro de carregamento: "Não foi possível carregar as reservas."

**Estados:**
- **Carregamento:** "Carregando reservas...".
- **Lista vazia:** mensagem de vazio.
- **Sucesso:** tabela/lista com reservas; `cancelada` visualmente distinta.
- **Sucesso (ação):** alerta e atualização do item/lista.
- **Erro:** alerta visível; manter dados carregados quando possível.

## 5. Desenho simples (celular e computador)

### 5.1 Princípio de layout

- **Mobile-first:** conteúdo em uma coluna, botões grandes e formulários empilhados.
- **Computador:** largura máxima centralizada (ex.: 960–1100px), busca e cards em grade quando houver espaço.
- **Componentes comuns:** cabeçalho com menu, área de alertas (sucesso/erro), cartões/listas e rodapé simples.

### 5.2 Wireframe textual — T01 Busca (celular)

```text
+----------------------------------+
| [≡] HotelReserva      [Entrar]   |
+----------------------------------+
| Buscar quartos                   |
| [Check-in        ____/__/____ ]  |
| [Check-out       ____/__/____ ]  |
| [Hóspedes        ( 2 )        ]  |
| [        BUSCAR              ]   |
+----------------------------------+
| Mensagem (erro/vazio/sucesso)    |
+----------------------------------+
| Card Quarto A                    |
| Capacidade: 2 | R$ 200/noite     |
| [Disponível]      [Reservar]     |
+----------------------------------+
| Card Quarto B                    |
| Capacidade: 3 | R$ 320/noite     |
| [Esgotado no período]            |
+----------------------------------+
```

### 5.3 Wireframe textual — T01 Busca (computador)

```text
+------------------------------------------------------------------+
| HotelReserva   Buscar   Minhas reservas/Entrar            [Sair]  |
+------------------------------------------------------------------+
|  Check-in [__/__/__]  Check-out [__/__/__]  Hóspedes [2] [BUSCAR]|
+------------------------------------------------------------------+
|  [Card Quarto A]   [Card Quarto B]   [Card Quarto C]             |
|  Disponível        Esgotado          Disponível                   |
|  [Reservar]                          [Reservar]                  |
+------------------------------------------------------------------+
```

### 5.4 Wireframe textual — T04 Confirmação / T05 Listas

```text
Celular (T04):                     Celular (T05):
+--------------------------+       +--------------------------+
| < Voltar  Confirmar      |       | Minhas reservas          |
+--------------------------+       +--------------------------+
| Quarto: Suíte X          |       | [Sucesso/erro]           |
| 10/08 a 12/08 (2 noites) |       | Reserva #1 - Confirmada  |
| Hóspedes: 2              |       | Datas / Valor            |
| Total: R$ 400,00         |       | [Cancelar reserva]       |
| [CONFIRMAR RESERVA]      |       |--------------------------|
+--------------------------+       | Reserva #2 - Cancelada   |
                                   +--------------------------+
```

### 5.5 Wireframe textual — T07/T08 Admin (computador)

```text
+------------------------------------------------------------------+
| Painel | Quartos | Reservas                               [Sair]  |
+------------------------------------------------------------------+
| Quartos                                    [+ Novo quarto]       |
| [Form criar/editar - quando aberto]                              |
| ---------------------------------------------------------------- |
| Nome        | Cap. | Preço | Qtde | Status  | Ações             |
| Standard    | 2    | 200   | 3    | Ativo   | Editar Desativar  |
| Família     | 4    | 350   | 1    | Inativo | Editar Ativar     |
+------------------------------------------------------------------+
```

## 6. Regras de navegação e segurança (resumo)

- Páginas restritas verificam sessão e perfil no servidor antes de renderizar conteúdo sensível.
- Acesso indevido: redirecionar para login (sem sessão) ou exibir bloqueio/redirecionar para área permitida (perfil incorreto).
- Após ações de escrita (login, reserva, cancelamento, CRUD), preferir redirecionamento com mensagem de feedback (padrão Post/Redirect/Get quando aplicável) para evitar reenvio.
- Manter critérios de busca ao retornar de erros de reserva quando possível (query string ou sessão temporária), melhorando a experiência sem comprometer segurança.
