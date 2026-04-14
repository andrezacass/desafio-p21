# Sistema de Gestão de Cartórios - Desafio P24h

Este sistema foi desenvolvido como parte de um desafio técnico para gestão de registros de cartórios. A aplicação permite o cadastro, edição, listagem e exclusão de cartórios de forma fácil e segura.

## Tecnologias Utilizadas
- **PHP 8.2 & Laravel 12**
- **MySQL** - Banco de Dados
- **Blade Engine** - Frontend (HTML Dinâmico)
- **JavaScript** - Máscaras e filtros dinâmicos

## Como Instalar e Rodar o Projeto

1. **Clonar o repositório:**
   ```bash
   git clone https://github.com/andrezacass/desafio-p21.git


## 🧠 Decisões Tomadas Durante o Desenvolvimento

Para garantir a qualidade e a funcionalidade do sistema, tomei as seguintes decisões:

* **Arquitetura MVC com Laravel 12:** Optei pela versão mais recente do framework para utilizar as melhores práticas de segurança e organização de pastas, separando claramente a lógica (Controller) da interface (View).
* **Integridade do Banco de Dados:** Implementei validações no Backend para garantir que o CNPJ seja único e que campos obrigatórios sejam validados antes da persistência no banco, evitando dados corrompidos.
* **Melhoria de UX (User Experience):** Decidi incluir máscaras de entrada para o CNPJ e um sistema de carregamento dinâmico de Municípios de acordo com o Estado (UF) selecionado, reduzindo erros de preenchimento.
* **Design Minimalista:** Escolhi uma interface limpa com um card centralizado e feedbacks visuais (badges de status), focando na produtividade do usuário final.   