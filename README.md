# Teste para desenvolvedor PHP pleno Feegow
projeto feito para o teste da feegow


# Funcionamento
Na tela inicial, o cliente pesquisa a especialidade desejada na lista:
![Tela inicial](https://user-images.githubusercontent.com/49003468/153772066-1faa121d-be1a-490b-ac8b-f0bb06a592c5.jpg)

apos escolher uma especialidade e clicar em agendar é apresentada a lista de todos os profissionais daquela especialidade, exibindo uma imagem genérica para os profissionais que não tem foto cadastrada e a foto do profissional quando cadastrada.
![pesquisa](https://user-images.githubusercontent.com/49003468/153772067-79ba4551-424d-4013-9b0c-dbc1fca8c54a.jpg)

ao clicar em agendar será solicitado ao cliente a inclusão de seus dados pessoais
![Agendamento](https://user-images.githubusercontent.com/49003468/153772070-c0b753be-81e9-4a56-b0f8-5d1c739b9406.jpg)

Os campos Nome, Nascimento e CPF são inseridos pelo cliente e o campo Como conheceu, é alimentado pela API como solicitado.
![dados](https://user-images.githubusercontent.com/49003468/153772075-537f9b8a-6615-4abc-a4b1-76dedc38e209.jpg)

Ao concluir o agnedamento, será exibida uma mensagem de confirmação
![agendamento realizado](https://user-images.githubusercontent.com/49003468/153772076-b0ab71d8-f192-40c3-b2e9-6aab9aa59bb8.jpg)


O registro é salvo no banco de dados ao fim do agendamento
![banco de dados](https://user-images.githubusercontent.com/49003468/153772063-cf932d7f-9911-45ec-b76a-432cc2856bf9.jpg)


# Para rodar o código, será necessário ter instalado:

- php 7.4+
- mysql
- composer
- laravel 8.0+

1- Digite o commando "composer install". Ele vai instalar todos os pacotes php necessários.

2- Digite o commando "php artisan key:generate". Esse vai gerar uma chave para a aplicação.

- No MySql crie um database chamado "agenda_feegow".
- Renomeie o arquvivo .env.example para .env e preencha os seus dados de conexão com o seu banco. (é importante que seja ete arquivo, pois o token para acesso a API está inserida nele como variável de ambiente).
- Execute o camndo php artisan migrate.
- Por fim execute o comando php artisan serve para iniciar o servidor.

accesse em 127.0.0.1:800

:)



