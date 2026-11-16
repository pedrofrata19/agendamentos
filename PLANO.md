# PLANO.md — HotelReserva (MVP)

Plano de implementação em tarefas pequenas e verificáveis, baseado no `PRODUCT.md`.  
**Regra desta etapa:** não implementar funcionalidades ainda; usar este plano como guia.

## 0. Estrutura proposta (simples, para iniciante)

```text
controle/
├─ index.php                 # Página inicial (busca / ponto de entrada)
├─ login.php                 # Formulário e processamento de login
├─ cadastro.php              # Formulário e processamento de cadastro
├─ logout.php                # Encerrar sessão
├─ minhas-reservas.php       # Lista de reservas do viajante (área restrita)
├─ reserva.php               # Confirmação/criação de reserva (área restrita)
├─ admin/
│  ├─ index.php              # Painel admin (resumo/redirecionamento)
│  ├─ quartos.php            # Listar/criar/editar/desativar quartos
│  └─ reservas.php           # Listar/cancelar reservas
├─ includes/
│  ├─ db.php                 # Conexão PDO (lê configuração)
│  ├─ auth.php               # Sessão, verificação de login/perfil, helpers
│  ├─ funcoes.php            # Funções reutilizáveis (ex.: disponibilidade, validações)
│  ├─ header.php             # Layout comum (topo/menu)
│  └─ footer.php             # Layout comum (rodapé)
├─ assets/
│  ├─ css/
│  │  └─ style.css           # Estilos básicos
│  └─ js/
│     └─ app.js              # Comportamentos de UI (opcional, sem lógica de segurança)
├─ config/
│  └─ config.exemplo.php     # Exemplo de configuração (sem segredos reais)
├─ sql/
│  └─ schema.sql             # Criação do banco/tabelas iniciais
├─ PRODUCT.md
├─ PLANO.md
└─ AGENTS.md
```

**Observações:**
- Manter a regra de negócio de disponibilidade centralizada (ex.: em `includes/funcoes.php`) para reutilizar em busca (F2) e reserva (F3).
- `config/` deve conter apenas exemplos versionados; credenciais reais ficam em arquivo local ignorado pelo Git (ver `AGENTS.md`).

## 1. Preparação do ambiente e base do projeto
- [ ] **T1.1 — Ambiente local:** XAMPP com Apache e MySQL ativos.
  - **Verificação:** abrir `http://localhost/controle/` sem erro de servidor.
- [ ] **T1.2 — Estrutura de pastas:** criar pastas `admin/`, `includes/`, `assets/css/`, `assets/js/`, `config/`, `sql/`.
  - **Verificação:** pastas existem conforme a estrutura proposta.
- [ ] **T1.3 — Layout base:** criar `includes/header.php` e `includes/footer.php` e incluir em `index.php`.
  - **Verificação:** página inicial renderiza cabeçalho/rodapé comuns sem quebrar.
- [ ] **T1.4 — Configuração de exemplo:** criar `config/config.exemplo.php` com chaves de banco (host, nome, usuário, senha) sem valores reais sensíveis.
  - **Verificação:** arquivo existe e documenta os campos necessários.
- [ ] **T1.5 — Conexão PDO (esqueleto):** preparar `includes/db.php` para usar PDO e prepared statements (sem expor credenciais no código).
  - **Verificação:** incluir `db.php` em uma página de teste local não gera erro quando configurado corretamente.

## 2. Banco de dados (modelo mínimo)
- [ ] **T2.1 — Script inicial:** criar `sql/schema.sql` com tabelas mínimas: `usuarios`, `quartos`, `reservas`.
  - **Verificação:** script executa no MySQL sem erros em banco limpo.
- [ ] **T2.2 — Campos essenciais:** incluir campos para perfil (`viajante`/`admin`), senha em hash, dados do quarto (capacidade, preço, quantidade, ativo) e reserva (datas, status `confirmada`/`cancelada`, valor).
  - **Verificação:** estrutura suporta as regras do `PRODUCT.md` (F1–F5, disponibilidade).
- [ ] **T2.3 — Usuário admin inicial (documentado):** definir no plano/README local como criar o primeiro admin (hash gerado, sem senha em texto puro no repositório).
  - **Verificação:** existe procedimento claro para obter um admin funcional em ambiente local.

## 3. F1 — Autenticação (planejamento de tarefas)
- [ ] **T3.1 — Cadastro:** página/fluxo de cadastro (nome, e-mail, senha) com validação no servidor e recusa de e-mail duplicado.
  - **Verificação:** e-mail repetido é recusado; senha armazenada apenas como hash.
- [ ] **T3.2 — Login/Logout:** autenticação com `password_verify`, criação de sessão e encerramento de sessão.
  - **Verificação:** credenciais válidas entram; inválidas falham; logout exige novo login.
- [ ] **T3.3 — Proteção de rotas:** helpers para exigir login e perfil (viajante/admin) em páginas restritas.
  - **Verificação:** acesso sem sessão redireciona para login; viajante não acessa `admin/*`.

## 4. F5 (parte 1) — Cadastro de quartos (admin)
- [ ] **T4.1 — Listagem de quartos (admin):** exibir quartos cadastrados.
  - **Verificação:** admin autenticado vê a lista; não-admin é bloqueado.
- [ ] **T4.2 — Criar quarto:** formulário com nome, descrição, capacidade, preço, quantidade.
  - **Verificação:** quarto criado aparece na listagem e pode ser usado na busca (quando F2 existir).
- [ ] **T4.3 — Editar/desativar quarto:** atualização de dados e flag de ativo/inativo.
  - **Verificação:** quartos inativos não aparecem na busca nem aceitam novas reservas.

## 5. F2 — Busca de disponibilidade
- [ ] **T5.1 — Formulário de busca:** check-in, check-out e nº de hóspedes em `index.php` (ou página dedicada).
  - **Verificação:** campos obrigatórios e mensagens de erro para datas inválidas.
- [ ] **T5.2 — Regra de disponibilidade no servidor:** função reutilizável que considera quartos ativos, capacidade e sobreposição de reservas `confirmada` (`[checkin, checkout)`).
  - **Verificação:** mesma lógica é chamada na busca e será reutilizada na criação de reserva.
- [ ] **T5.3 — Exibição de resultados:** mostrar quartos compatíveis com indicador Disponível/Esgotado e mensagem "Nenhum quarto encontrado" quando aplicável.
  - **Verificação:** resultados refletem o estado real do banco.

## 6. F3 — Criação de reserva
- [ ] **T6.1 — Acesso restrito:** iniciar reserva apenas autenticado como viajante.
  - **Verificação:** usuário não logado é redirecionado ao login.
- [ ] **T6.2 — Resumo e valor total:** exibir quarto, datas e total (noites × preço).
  - **Verificação:** cálculo correto para o período selecionado.
- [ ] **T6.3 — Revalidação e gravação:** checar disponibilidade novamente no servidor e gravar reserva `confirmada` (preferir transação).
  - **Verificação:** tentativa concorrente/esgotamento gera recusa clara; sucesso aparece em "Minhas reservas".

## 7. F4 — Minhas reservas e cancelamento (viajante)
- [ ] **T7.1 — Listagem do usuário:** mostrar apenas reservas do usuário logado com quarto, datas, status e valor.
  - **Verificação:** não há vazamento de reservas de outros usuários.
- [ ] **T7.2 — Cancelamento:** permitir cancelar apenas reserva `confirmada` do próprio usuário.
  - **Verificação:** status muda para `cancelada` e quarto volta a ficar disponível no período.

## 8. F5 (parte 2) — Gestão de reservas (admin)
- [ ] **T8.1 — Listar todas as reservas:** exibir viajante, quarto, datas e status.
  - **Verificação:** apenas admin acessa.
- [ ] **T8.2 — Cancelar reserva (admin):** alterar status para `cancelada` e liberar disponibilidade.
  - **Verificação:** nova busca reflete a liberação.

## 9. Fechamento do MVP
- [ ] **T9.1 — Revisão de segurança básica:** prepared statements em todo SQL, escape de saída, validação no servidor, senhas com hash.
  - **Verificação:** checklist do `PRODUCT.md` (seções 8 e 10) atendido.
- [ ] **T9.2 — Teste de ponta a ponta:** executar os cenários descritos em `AGENTS.md`.
  - **Verificação:** fluxos de viajante e admin concluídos sem erros críticos.
