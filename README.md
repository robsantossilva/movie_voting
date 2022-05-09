
# Applicação para Avaliação de Filmes da Marvel

Essa aplicação tem como objetivo forncecer uma **API Rest** juntamente com uma **Single Page Application**.
O Resultado final é a possibilidade de **avaliar filmes da marvel** variando entre **1 e 5 estrelas**.

## Ponto de Partida

#### 1 - Contextos:
Analisando os requisitos foi possivel identificar 2 contextos diferentes para a aplicação:

**Video**
Responsavel por gerencia todos os filmes, séries, filmes de longa ou curta duração dentre outros...
Esse contexto também fará o gerenciamento de Cast Members e Genres.

**Assessment**
O Contexto de avaliação será responsavel por gerenciar todos os votos e cálculo da nota média.

#### 2 - Decisões de Design

**Dominio da Aplicação:** Naturalmente cada contexto tornou-se um módulo dentro do dominio da aplicação que tem como principal objetivo tratar de Regras de Negócio. **Nesse ponto** nada sobre framework ou banco de dados foi decido pois são apenas detalhes, visto que resolver o problema é muito mais importante.

- **Domain**
  - Assessment
    - Entity
    - Factory
    - Repository
    - Validator
  - Video
    - Entity
    - Factory
    - Repository
    - Validator
    - ValueObject: Genre e CastMember
  - SharedCore: Contem interfaces e recursos compartilhados entre módulos
    - Entity
    - Factory
    - Repository
    - Validator
    - Notification: Pattern para agrupar Exception de errors dentro da camada de dominio
- **Usecase**
  - Video: Casos de uso de video
  - Vote: Casos de uso de votos
- **Infraestructure**: É a ultima camada a nivel de prioridade. Aqui estara todas as implementações referente a Framework e Banco de Dados.

O Principal objetivo dessa organização em camadas é proporcionar um menor acoplamento, entre as implementações diminuindo a dependencia entre elas e facilitando a evolução do projeto.

#### 3 - Framework / Banco de Dados
Foi utiliza Laravel juntamente com Mysql por ser uma combinação bem utilizada.
Lembrando que a arquiterura do projeto facilita a mudança do banco, que pode ser qualquer um.
