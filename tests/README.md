# Testes

Criar teste é importante e blah blah blah... Todo mundo sabe disso, mas nesse
projeto não dá pra testar tudo porque é muito trabalhoso e desnecessário. Então
só escreva teste para as partes críticas do sistema (checkout, parte de
pagamento, etc). Então vamos seguindo.

Antes de tudo, para rodar os testes é preciso executar o script
scripts/setup_tests.sh. Ele copia o .env e cria um banco para test. Sem esse
passo os testes podem falhar sem motivo. Feito isso, pode seguir com a criação
e/ou executação dos testes.

Com o projeto configurado, saiba que você não vai, na maior parte, conseguir
fazer um teste seguindo um fluxo. Ex.: Testar o checkout de um plano. Pois o
sistema lança muitos jobs e isso atrapalha o fluxo. Se tiver com problemas,
quebre os testes. Ex.: Um teste simples de Feature para ver a chamada do
controlador e outros testes para ver a chamada dos serviços ou dos jobs
separadamente.

Na v1 a gente tinha o custume de criar um database/factories/ com relações para
outras factories. Não faça isso! Evite fazer qualquer coisa muito complicada,
pois isso provavelmente vai quebrar outros testes. Então só crie factories e
states. Nada de criar relações ou usar callbacks. Se precisa de algo mais
complicado, crie uma factory em tests/Setup/.

Os testes não precisam seguir padrão de nomes de código. Use o nome da classe e
do método para descrever o teste. Se a classe vai testar todos os casos de
novas assinatuas. Então crie um NewSubscriptionTest e coloque apenas os métodos
referentes as novas assinaturas. Evite criar uma classe com nome muito genérico
como SubscriptionTest.

A diferença entre os testes de Feature e os unitários é que os de Feature testa
várias classes ao mesmo tempo e os unitários apenas uma classe ou método. Na
dúvida, para saber qual tipo de teste você precisa criar é só fazer a pergunta:
"Eu vou precisar chamar uma requisção HTTP pro controlador?". Se for sim, então
crie um teste de Feature, senão crie um teste unitário.

Não se preocupe muito se os testes são repetitivos. Repetição em testes até que
deixa o código mais legível. Normalmente você só vai pensar em refatorar a
repetição quando tá demais. Se a repetição é no setup, é só criar um factory no
tests/Setup. Nos outros casos você pode criar um método normal na classe de
teste.

Por enquanto é só e boa sorte nos testes :D
