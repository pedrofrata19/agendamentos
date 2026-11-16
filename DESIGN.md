# DESIGN.md — HotelReserva (MVP)

Diretrizes visuais e de interface para o MVP, alinhadas a `PRODUCT.md` e `NAVEGACAO.md`. O objetivo é um design simples, legível e consistente em celular e computador, usando HTML, CSS e JavaScript puro.

## 1. Princípios

- **Clareza:** informações essenciais primeiro (datas, disponibilidade, preço total, status da reserva).
- **Simplicidade:** poucos componentes, sem bibliotecas visuais externas no MVP.
- **Consistência:** mesmos padrões de botões, formulários, alertas e estados em todas as telas.
- **Mobile-first:** projetar para telas pequenas e expandir para desktop.
- **Acessibilidade básica:** contraste adequado, foco visível, labels associados a campos e mensagens compreensíveis.
- **Feedback explícito:** toda ação relevante deve resultar em estado de carregamento, sucesso, erro ou vazio.

## 2. Layout responsivo

### 2.1 Breakpoints sugeridos

| Faixa | Largura | Comportamento |
|---|---|---|
| Mobile | até 767px | 1 coluna, menu compacto, botões em largura total quando principal |
| Tablet/Desktop | a partir de 768px | container centralizado, formulários em linha quando apropriado, listas/cards em grade |

### 2.2 Estrutura de página

```text
+------------------------------------------------------+
| Header (logo + navegação por perfil)                 |
+------------------------------------------------------+
| Área de alertas (sucesso/erro/info)                  |
+------------------------------------------------------+
| Conteúdo principal (container, max-width 1100px)     |
| - título da página                                   |
| - formulário / cards / tabela                        |
+------------------------------------------------------+
| Footer simples (nome do sistema/ano)                 |
+------------------------------------------------------+
```

- **Container:** `max-width: 1100px; margin: 0 auto; padding: 16px;`
- **Mobile:** reduzir espaçamentos laterais (ex.: 12–16px) e empilhar elementos.
- **Desktop:** permitir linhas de formulário (busca) e grades de cards com `gap` consistente.

## 3. Identidade visual (simples)

### 3.1 Paleta sugerida

| Uso | Cor sugerida | Hex (referência) |
|---|---|---|
| Primária (ações principais) | Azul | `#2563EB` |
| Primária (hover) | Azul escuro | `#1D4ED8` |
| Fundo da página | Cinza muito claro | `#F3F4F6` |
| Superfície (cards/form) | Branco | `#FFFFFF` |
| Texto principal | Cinza escuro | `#111827` |
| Texto secundário | Cinza médio | `#4B5563` |
| Borda | Cinza claro | `#D1D5DB` |
| Sucesso | Verde | `#16A34A` |
| Erro | Vermelho | `#DC2626` |
| Aviso/info | Âmbar/Azul claro | `#D97706` / `#0284C7` |
| Status cancelada | Cinza | `#6B7280` |

> Cores são referenciais; manter contraste suficiente (texto escuro em fundo claro, texto branco em botões primários).

### 3.2 Tipografia

- **Fonte:** stack nativa do sistema para simplicidade e desempenho, ex.: `system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif`.
- **Tamanhos base:** corpo `16px`, títulos de página `24–28px`, subtítulos `18–20px`, texto auxiliar `14px`.
- **Peso:** títulos `600–700`, labels `500–600`, corpo `400`.
- **Linha:** `line-height: 1.5` para leitura confortável.

### 3.3 Espaçamento e forma

- **Escala de espaçamento:** 4, 8, 12, 16, 24, 32px.
- **Raio de borda:** 6–8px para inputs, botões e cards.
- **Sombra (leve, opcional):** `0 1px 3px rgba(0,0,0,0.08)` em cards.
- **Bordas:** 1px sólida `#D1D5DB` em inputs e divisores.

## 4. Componentes de interface

### 4.1 Cabeçalho e navegação

- **Conteúdo:** logo/nome à esquerda; links/ações à direita (desktop) ou menu colapsado (mobile).
- **Itens por perfil:** conforme `NAVEGACAO.md` (visitante, viajante, admin).
- **Estado ativo:** destacar link da página atual (cor primária ou sublinhado).
- **Mobile:** botão de menu acessível (`aria-label="Abrir menu"`, `aria-expanded`), lista expandida em coluna.

### 4.2 Botões

| Tipo | Uso | Estilo |
|---|---|---|
| Primário | Buscar, Entrar, Confirmar reserva, Salvar | Fundo primário, texto branco |
| Secundário | Voltar, Cancelar edição, Nova busca | Fundo branco, borda/cor primária |
| Perigo | Cancelar reserva, Desativar (quando aplicável) | Fundo/contorno vermelho, confirmação antes da ação |
| Desabilitado | Esgotado, envio em andamento | Opacidade reduzida, cursor `not-allowed`, sem ação |

- Altura mínima recomendada: ~44px em mobile (área de toque).
- Texto de ação claro e específico (ex.: "Confirmar reserva", não apenas "OK").

### 4.3 Formulários

- **Label:** sempre visível e associado ao campo (`for`/`id`).
- **Campos:** largura 100% em mobile; agrupáveis em linha no desktop (ex.: busca).
- **Ajuda/erro:** texto auxiliar abaixo do campo; erros com cor de erro e mensagem objetiva.
- **Validação visual:** borda vermelha em campo inválido; não depender apenas de cor (incluir texto).
- **Preservação de dados:** manter valores preenchidos após erro de validação (exceto senhas).

### 4.4 Alertas e mensagens

- **Sucesso:** fundo verde claro, borda/texto verde, ícone opcional.
- **Erro:** fundo vermelho claro, borda/texto vermelho.
- **Info/aviso:** fundo azul/âmbar claro.
- **Posição:** topo do conteúdo principal, visível sem rolagem excessiva quando possível.
- **Comportamento:** mensagens de resultado de ação devem ser claras; podem ser persistidas entre redirect (flash em sessão) quando aplicável.

### 4.5 Cards e listas

- **Uso:** resultados de busca (T01), reservas do viajante (T05), resumo no admin quando útil.
- **Conteúdo mínimo do card de quarto:** nome, descrição curta, capacidade, preço/noite, indicador de disponibilidade, ação.
- **Conteúdo mínimo do card/item de reserva:** quarto, período, valor, status, ação (se aplicável).
- **Status visual:**
  - `confirmada`: badge verde/azul ("Confirmada").
  - `cancelada`: badge cinza ("Cancelada"), item com menor destaque visual.

### 4.6 Tabelas (admin)

- **Desktop:** tabela com cabeçalho, linhas legíveis e coluna de ações.
- **Mobile:** transformar em cards/lista empilhada ou permitir rolagem horizontal controlada; preferir cards para evitar perda de legibilidade.
- **Dados:** evitar excesso de colunas; priorizar identificação, datas, status e ação.

## 5. Estados de interface

| Estado | Quando usar | Apresentação recomendada |
|---|---|---|
| Carregamento | Requisição/envio em andamento | Texto de status ("Buscando...", "Salvando..."), botão desabilitado; skeleton opcional em listas |
| Vazio | Busca sem resultados, sem reservas/quartos | Mensagem explicativa + ação útil (ex.: "Nova busca", "Novo quarto") |
| Sucesso | Ação concluída ou dados carregados | Conteúdo normal + alerta de sucesso quando houver ação |
| Erro | Falha de validação, indisponibilidade, erro geral | Alerta de erro + orientação; preservar contexto/dados quando seguro |
| Desabilitado/bloqueado | Quarto esgotado, perfil sem permissão, ação indisponível | Elemento visualmente inativo e, quando necessário, mensagem explicativa |

## 6. Responsividade por tela (resumo)

- **T01 (Busca):** mobile com campos empilhados e botão largo; desktop com campos em linha. Resultados em 1 coluna (mobile) / grade (desktop).
- **T02/T03 (Auth):** formulário centralizado, largura limitada (ex.: 420px) em desktop.
- **T04 (Confirmação):** card/resumo centralizado com valor total em destaque.
- **T05/T08 (Reservas):** lista de cards no mobile; cards ou tabela simplificada no desktop.
- **T07 (Quartos):** formulário de criação/edição acima ou em bloco destacado; listagem adaptada como tabela/cards.
- **T06 (Painel):** cards de atalho grandes, empilhados no mobile e lado a lado no desktop.

## 7. Acessibilidade básica (MVP)

- Usar HTML semântico (`header`, `nav`, `main`, `section`, `footer`, `button`, `label`).
- Garantir ordem lógica de tabulação e foco visível (`:focus`).
- Não transmitir informação apenas por cor (status deve ter texto: "Confirmada", "Esgotado").
- Fornecer textos alternativos se imagens forem adicionadas futuramente.
- Mensagens de erro associáveis aos campos quando possível (`aria-describedby`).

## 8. Implementação (orientação para CSS/JS)

- **CSS:** arquivo único inicial `assets/css/style.css` com variáveis CSS para cores/espaçamentos, estilos base, componentes e media queries.
- **JS (`assets/js/app.js`):** apenas melhorias de UX (ex.: confirmação antes de cancelar, toggle de menu mobile, feedback de envio). **Não** substituir validações/regras do servidor.
- **Sem dependências externas:** não usar frameworks CSS/JS no MVP.
- **Consistência:** reutilizar classes utilitárias/componentes simples (ex.: `.btn`, `.btn-primary`, `.alert`, `.alert-error`, `.card`, `.badge`). 

## 9. Fora de escopo visual no MVP

- Identidade visual complexa/branding avançado, animações elaboradas, dark mode, design system completo, componentes de terceiros, upload/galeria de fotos e gráficos/relatórios visuais. 
