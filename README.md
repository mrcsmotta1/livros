# 📚 Desafio Técnico — Sistema de Cadastro de Livros, Autores e Assuntos
Este projeto é um **sistema de cadastro e gerenciamento de livros, autores e assuntos**, desenvolvido em **Laravel**, utilizando **Docker** e **PostgreSQL**.  
Foi criado como um **desafio técnico**, com foco em **boas práticas de arquitetura**, **testes automatizados** e **cobertura de código**.  
O objetivo é demonstrar um ambiente Laravel moderno, totalmente containerizado, com:
- 🐳 execução via **Docker Compose**;
- ⚙️ **migrations**, **seeders** e **rotas resource** para entidades principais;
- 🧠 **testes automatizados** e **relatório de cobertura** com **Xdebug**;
- 🧾 código limpo e padronizado conforme **PSR-12**.

---

## 🧰 Requisitos Mínimos
| Ferramenta | Versão mínima | Descrição |
|-------------|----------------|------------|
| **Docker** | 24+ | Gerenciamento de containers |
| **Docker Compose** | 2+ | Orquestração do ambiente |
| **Git** | 2.30+ | Controle de versão |
| **RAM recomendada** | 4 GB | Execução estável dos containers |

---

## 💾 Tecnologias Utilizadas
| Tecnologia | Versão | Função |
|-------------|---------|---------|
| **PHP** | 8.2+ | Linguagem principal |
| **Laravel** | 12.x | Framework backend |
| **PostgreSQL** | 15+ | Banco de dados relacional |
| **Docker / Docker Compose** | latest | Orquestração de containers |
| **Xdebug** | 3.x | Geração de cobertura de testes |
| **PHPUnit** | 11.x | Framework de testes |
| **Composer** | 2.x | Gerenciador de dependências |

---

## ⚙️ Setup Inicial
1. **Suba os containers Docker:**
```bash
docker compose up -d
```
2. **Crie o arquivo de configuração `.env`:**
```bash
cp .env.example .env
```
3. **Dê permissões ao usuário correto para escrita de logs:**
```bash
docker compose exec app chown -R www-data:www-data /app/storage
```
4. **Crie o link simbólico de imagens (`storage → public`):**
```bash
docker compose exec app php artisan storage:link
```
5. **Execute as migrations:**
```bash
docker compose exec app php artisan migrate
```

6. **Compile os assets:**
```bash
docker compose exec app npm install && npm run mix
```

---

## 🧪 Execução de Testes
> 💡 **Dica:** Mantenha o Xdebug desativado para melhor desempenho nos testes normais.
```bash
docker compose exec app env XDEBUG_MODE=off php artisan test --testdox
```

---

## 🧠 Cobertura de Testes (Xdebug)
> ⚙️ **Para gerar o relatório de cobertura de testes:**
```bash
docker compose exec app env XDEBUG_MODE=coverage php artisan test --coverage-html storage/coverage --colors=always
```
> 🔗 **Crie (ou recrie) o link simbólico para acessar o relatório no navegador:**
```bash
docker compose exec app rm -f /app/public/coverage && docker compose exec app ln -s /app/storage/coverage /app/public/coverage
```

---

## 📊 Relatório de Cobertura
Após gerar a cobertura e criar o link simbólico, acesse no navegador:

- **Index do relatório:**  
  [http://localhost:9000/coverage/index.html](http://localhost:9000/coverage/index.html)

- **Dashboard consolidado:**  
  [http://localhost:9000/coverage/dashboard.html](http://localhost:9000/coverage/dashboard.html)

> **Observação:** os arquivos são gerados em `storage/coverage` e servidos publicamente via o link simbólico `public/coverage`.

---

## 🌐 Acesso à Aplicação
> **📄 Página inicial da aplicação:**  
> [http://localhost:9000](http://localhost:9000)

---

## 🧹 Limpeza de Relatórios e Cache (opcional)
> ⚙️ **Para apagar relatórios antigos e cache do PHPUnit:**
```bash
docker compose exec app rm -rf /app/storage/coverage
docker compose exec app rm -f /app/.phpunit.result.cache
```

---

## 🧰 Comandos Úteis
**Limpar cache da aplicação:**
```bash
docker compose exec app php artisan optimize:clear
```
**Reiniciar containers:**
```bash
docker compose down && docker compose up -d
```
**Acessar o container da aplicação:**
```bash
docker compose exec app bash
```

---

## 🧩 Estrutura de Módulos
| Módulo | Descrição |
|---------|------------|
| **Livros** | Cadastro e gerenciamento de livros. |
| **Autores** | Cadastro e edição de autores. |
| **Assuntos** | Classificação e gerenciamento de temas. |
| **Relatório Autor** | Inclui funcionalidade de **exportação de relatório em CSV**, permitindo o download completo dos registros. |
Cada módulo segue o padrão **MVC**, com **rotas RESTful**, **validações via FormRequest**, **Services**, **Repositories** e **testes automatizados**.


---

> [!NOTE]  
> Este projeto foi desenvolvido como um **desafio técnico Laravel**, servindo também como **base para novos sistemas containerizados** com integração entre **PHP, PostgreSQL e Docker**.  
> Ele utiliza boas práticas de organização de código, versionamento e testes para garantir **qualidade, portabilidade e reprodutibilidade** do ambiente de desenvolvimento.
