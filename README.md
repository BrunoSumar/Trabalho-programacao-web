# Trabalho programação web

> Trabalho para a disciplina programação web uff-RO 2020.

#### Tasks
O tema do trabalho é uma aplicação para gerência de url's. A aplicação deverá conter usuários. As url's podem ser públicas ou privadas (configurável) a estes usuários. Cada url pode ter diversas tags (categorias), de forma a facilitar a busca destas.
 - [ ] 1) Criação de interface com HTML, CSS e JS para a aplicação (frontend): telas de login e de criação, remoção e busca de conteúdos.
 - [x] 2) Criação de um servidor (backend) para persistir o conteúdo da aplicação. A persistência pode ser feita por banco ou qualquer outro meio. Caso não seja feita por banco, observe que outros tipos de dados poderão ser persistidos ao longo do projeto. A comunicação entre frontend e backend deve ser feita por API (serviço).
 - [x] 3) A aplicação deve permitir atualização automática. Caso 2 telas estejam abertas e o usuário realize uma modificação numa tela, a outra precisa receber a atualização de forma assíncrona (sem o usuário dar refresh na tela) Esta implementação é feita usando AJAX (Asynchronous JavaScript And XML), que mais recentemente pode ser feito pelo comando fetch do JS. 
 - [x] 4) O projeto no backend deve implementar o padrão MVC.
 - [ ] 5) Na implementação de login de usuários, a autenticação deve ser feita de 2 formas: 1) autenticação em 2 passos, via e-mail, SMS, ou algum outro mecanismo; 2) usando alguma API de autenticação, como Facebook API ou GitHub API. Na primeira forma devemos armazenar as senhas dos usuários no banco de forma cifrada. 
 - [ ] 6) A demonstração do sistema deve ser realizada usando Docker. O projeto deve estar armazenado no Github desde o primeiro dia.

