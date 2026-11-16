# PRODUCT.md — HotelReserva

## 1. Visão do produto

**HotelReserva** é um site de reserva de quartos para um **único hotel**. Viajantes
consultam disponibilidade por datas e reservam um quarto; o administrador do hotel
cadastra quartos e acompanha/cancela reservas. Não há processamento de pagamento real.

**Objetivo do MVP:** entregar o fluxo completo de busca → reserva → cancelamento para o
viajante, e o fluxo operacional de cadastro de quartos → gestão de reservas para o admin,
com regras de disponibilidade validadas no servidor.

---

## 2. Escopo

### Dentro do escopo (MVP)

- Dois perfis: **viajante** e **administrador**.
- Um único hotel (quartos cadastrados manualmente pelo admin).
- Busca de disponibilidade por data de check-in/check-out e nº de hóspedes.
- Criação de reserva com status `confirmada` (confirmação automática).
- Cancelamento de reserva pelo viajante e pelo admin.
- CRUD de quartos pelo admin (criar, editar, ativar/desativar).
- Autenticação por e-mail/senha com sessão.

### Fora do escopo (MVP)

- Pagamento real / gateway de pagamento.
- Aprovação manual de reserva.
- Múltiplos hotéis / marketplace.
- Upload de fotos, e-mails transacionais, avaliações, relatórios analíticos,
  recuperação de senha, i18n, WebSocket.
- "Tempo real" via push: a disponibilidade é consultada no servidor a cada busca
  (atualização assíncrona via `fetch` é refinamento de UX, não requisito do MVP).

---

## 3. Stack e arquitetura

- **Frontend:** HTML, CSS, JavaScript.
- **Backend:** PHP puro.
- **Banco:** MySQL (acesso via PDO com prepared statements).
- **Autenticação:** sessão PHP (`$_SESSION`) + `password_hash`/`password_verify`.
- **Entrega:** site funcional (não é API isolada, não é app mobile).

**Princípios técnicos obrigatórios**

- Toda entrada do usuário é validada **no servidor** (o JS é conveniência, não garantia).
- SQL sempre com prepared statements; saída sempre escapada com `htmlspecialchars()`.
- Regra de disponibilidade implementada uma única vez e reutilizada na busca (F2)
  e na criação de reserva (F3).

---

## 4. Perfis de usuário

| Perfil | Descrição | Pode acessar |
|---|---|---|
| **Viajante** | Pessoa interessada em hospedagem | Busca, reserva, "minhas reservas", cancelamento das próprias reservas |
| **Administrador** | Gestor do hotel | Painel admin: CRUD de quartos, lista e cancelamento de reservas |

Acesso a áreas restritas exige sessão ativa; o perfil é verificado no servidor.

---

## 5. Funcionalidades essenciais do MVP

### F1 — Autenticação de usuários (viajante e admin)

**História de usuário**

> Como **viajante** (ou administrador), quero me cadastrar e entrar com e-mail e senha
> para acessar as áreas restritas do sistema conforme meu perfil.

**Critérios de aceitação**

- [ ] Consigo me cadastrar informando nome, e-mail e senha; o sistema recusa e-mail já existente com mensagem clara.
- [ ] Consigo fazer login com e-mail e senha corretos e sou redirecionado para a área do meu perfil.
- [ ] Login com senha errada exibe mensagem de erro e não autentica.
- [ ] Sem sessão ativa, ao tentar acessar `minhas-reservas.php` ou `admin/*`, sou redirecionado para o login.
- [ ] Um usuário com perfil `viajante` que tenta acessar `admin/*` é bloqueado.
- [ ] Consigo sair (logout) e, após isso, as áreas restritas voltam a exigir login.
- [ ] A senha é armazenada como hash (não aparece em texto puro no banco).

---

### F2 — Busca de disponibilidade por datas

**História de usuário**

> Como **viajante**, quero informar check-in, check-out e número de hóspedes para ver
> quais quartos estão disponíveis no período, com preço e capacidade.

**Critérios de aceitação**

- [ ] O formulário de busca aceita check-in, check-out e nº de hóspedes.
- [ ] Datas inválidas (check-out ≤ check-in, data no passado) exibem mensagem de erro e **não** retornam resultados.
- [ ] A busca lista apenas quartos **ativos** com `capacidade ≥ hóspedes`.
- [ ] Cada quarto exibe nome, descrição, capacidade, preço por noite e um indicador **"Disponível"** ou **"Esgotado no período"**.
- [ ] Se um quarto já tem todas as unidades reservadas (status `confirmada`) no período, aparece como **Esgotado**.
- [ ] Se não houver nenhum quarto compatível, aparece a mensagem "Nenhum quarto encontrado".
- [ ] A verificação de disponibilidade é feita **no servidor** (não apenas no navegador).

---

### F3 — Criação de reserva

**História de usuário**

> Como **viajante** autenticado, quero reservar um quarto disponível para as datas
> escolhidas, para garantir minha hospedagem.

**Critérios de aceitação**

- [ ] Só consigo iniciar a reserva estando logado; caso contrário, sou levado ao login.
- [ ] A tela de reserva mostra o quarto, as datas e o **valor total** (noites × preço).
- [ ] Ao confirmar, o sistema **revalida a disponibilidade no servidor**; se o quarto esgotou nesse meio-tempo, a reserva é recusada com mensagem clara.
- [ ] Uma reserva criada com sucesso é gravada com status **`confirmada`** e aparece em "Minhas reservas".
- [ ] Reservar reduz a disponibilidade daquele quarto no período (uma nova busca passa a refletir a ocupação).
- [ ] Não é possível criar reserva com datas inválidas ou quarto inativo.

---

### F4 — "Minhas reservas" e cancelamento pelo viajante

**História de usuário**

> Como **viajante**, quero ver minhas reservas e poder cancelar uma reserva para liberar
> o quarto caso mude de planos.

**Critérios de aceitação**

- [ ] "Minhas reservas" lista apenas as reservas do usuário logado, com quarto, datas, status e valor.
- [ ] Reservas `canceladas` aparecem visualmente distintas das `confirmadas`.
- [ ] Consigo cancelar uma reserva `confirmada`; o status muda para `cancelada`.
- [ ] Após o cancelamento, o quarto volta a aparecer como disponível naquele período em uma nova busca.
- [ ] Não consigo cancelar reserva de outro usuário nem uma reserva já cancelada.

---

### F5 — Painel do administrador (quartos e reservas)

**História de usuário**

> Como **administrador**, quero cadastrar/editar quartos e visualizar/cancelar reservas
> para manter a operação do hotel em ordem.

**Critérios de aceitação**

- [ ] O admin consegue **criar** um quarto informando nome, descrição, capacidade, preço e quantidade; o quarto passa a aparecer na busca do viajante.
- [ ] O admin consegue **editar** os dados de um quarto e **desativá-lo**; quartos inativos deixam de aparecer na busca.
- [ ] O admin vê a **lista de todas as reservas** com viajante, quarto, datas e status.
- [ ] O admin consegue **cancelar** uma reserva; o status muda para `cancelada` e o quarto é liberado no período.
- [ ] O admin **não** consegue acessar funcionalidades de viajante que não lhe pertencem (ex.: "minhas reservas" de outro usuário) e vice-versa.

---

## 6. Funcionalidades futuras (fora do MVP)

| # | Funcionalidade | Motivo de adiamento |
|---|---|---|
| 1 | Pagamento / gateway | Fora do escopo confirmado; adiciona complexidade e riscos. |
| 2 | Aprovação manual de reserva pelo admin | MVP usa confirmação automática. |
| 3 | Upload de fotos dos quartos | Melhora a apresentação, não o fluxo. |
| 4 | E-mails transacionais (confirmação/cancelamento) | Requer SMTP; não bloqueia o núcleo. |
| 5 | Múltiplos hotéis / marketplace | Escopo é hotel único. |
| 6 | Avaliações e comentários | Depende de reservas concluídas. |
| 7 | Relatórios de ocupação e receita | Painel admin do MVP é operacional. |
| 8 | Recuperação de senha | Conveniência pós-login básico. |
| 9 | Atualização de disponibilidade em tempo real (AJAX/WebSocket) | Refinamento de UX; MVP consulta no servidor. |
| 10 | i18n / acessibilidade avançada | Polimento, não funcionalidade de negócio. |

---

## 7. Dependências entre funcionalidades

- **F1 (Autenticação)**
    - pré-requisito de F3, F4 e F5.
- **F5 (Admin: cadastro de quartos)**
    - pré-requisito de F2 (sem quartos cadastrados, a busca não tem o que listar).
- **F2 (Busca/disponibilidade)**
    - pré-requisito de F3 (só se reserva o que aparece como disponível).
- **F3 (Criação de reserva)**
    - pré-requisito de F4 (não há o que listar/cancelar sem reserva).

**Ordem de implementação recomendada:** F1 → F5 (só o CRUD de quartos) → F2 → F3 → F4 → F5 (parte de reservas do admin).

**Observações**

- **F1** é fundação: sem ela, F3/F4/F5 não têm como restringir acesso.
- Da **F5**, a parte de **cadastro de quartos** precisa vir cedo, porque sem quartos a
  **F2** não tem dados para mostrar; a parte de **gestão de reservas** pode vir depois da F3.
- A **F2** depende da regra de disponibilidade que também é usada em F3 — implementar a
  verificação no servidor uma vez e reutilizar.
- **F4** depende de F3 existir.

---

## 8. Regras de negócio centrais

- **Disponibilidade:** um quarto está disponível no período se o número de reservas
  `confirmada` que se sobrepõem ao intervalo `[checkin, checkout)` for **menor** que a
  `quantidade` cadastrada para aquele quarto. Sobreposição ocorre quando
  `NOT (checkout_reserva <= checkin_busca OR checkin_reserva >= checkout_busca)`.
- **Status de reserva:** `confirmada` (criada) ou `cancelada` (liberada). Não há `pendente`
  no MVP, pois não há pagamento nem aprovação manual.
- **Validação de datas:** check-in não pode ser no passado; check-out deve ser
  estritamente posterior ao check-in. Validação sempre no servidor.
- **Revalidação:** a disponibilidade é checada novamente no momento de criar a reserva,
  não só na busca.
- **Restrição por perfil:** viajante não acessa `admin/*`; admin não acessa dados de
  viajantes que não lhe pertencem.
- **Quartos inativos** não aparecem na busca nem podem receber novas reservas.

---

## 9. Critério de "MVP pronto"

O MVP está concluído quando:

- Um **viajante** consegue se cadastrar, buscar quartos por datas, reservar, ver e
  cancelar sua reserva.
- Um **administrador** consegue cadastrar/editar/desativar quartos e listar/cancelar
  reservas.
- Todas as regras de disponibilidade são validadas **no servidor**.
- O acesso é restrito por perfil e exige sessão ativa.
- Nenhuma das funcionalidades listadas como "fora do escopo" é necessária para o fluxo
  completo funcionar.

---

## 10. Riscos e cuidados técnicos

- **SQL injection:** uso obrigatório de PDO com prepared statements.
- **XSS:** escapar toda saída com `htmlspecialchars()`.
- **Senhas:** armazenar apenas hash (`password_hash`), nunca texto puro.
- **Race condition:** dois usuários reservando a última unidade ao mesmo tempo.
  Mitigação mínima: revalidação no servidor; mitigação recomendada: checagem + insert
  em transação (`BEGIN … COMMIT`).
- **Datas:** usar `DATE` no MySQL e `DateTimeImmutable` no PHP; validar no backend.

---

## 11. Glossário

- **Viajante:** usuário que busca e reserva quartos.
- **Administrador:** usuário que gerencia quartos e reservas.
- **Quarto:** tipo de acomodação com capacidade, preço por noite e quantidade de unidades.
- **Reserva:** vínculo entre um viajante e um quarto em um período, com status.
- **Disponibilidade:** existência de ao menos uma unidade livre do quarto no período.
- **Overbooking:** reservas confirmadas acima da quantidade de unidades do quarto — deve
  ser impedido pelas regras de disponibilidade.