<h2 style="color:#F00">NOTA</h2>
Tutorial: http://codezeus.com.br/tutorial.mp4<br/>
Este Projeto possui o frontend desacomplando deste repositório, para que possamos de fato testar a  API. Neste caso iremos iniciar configurando a parte do backend(a API em si),   para 
somente depois configurar o front.

<h2>Requisitos para rodar o projeto deste repositório(backend)</h2>
<p>O projeto foi feito utilizando laravel 7, para que ele rode temos que seguir os requisitos da própia documentação <a href="https://laravel.com/docs/7.x/installation#server-requirements"> CLIQE AQUI P IR A DOCUMENTAÇÃO</a></p>
<p>
	Após clonar o projeto do github (git clone https://github.com/Schielke-code/ApiProdutosBackend.git) abra a pasta do projeto e rode os seguinte comando dentro do terminal:
	'composer install'
</p>
<p>
	Concluindo esta etapa copie o arquivo ".env.example" e cole renomeando para ".env (cole no mesmo diretório do .env.example)"
</p>

<p>
	Abra novamente o seu terminal e gere uma chave com o seguinte comando:  'php artisan key:generate'
</p>

<p>
	Agora vamos limpar o seu arquivo de configuração usando o comando:  'php artisan config:clear' em seguida  'php artisan storage:link' para que possamos visualizar e enviar as imagens
</p>


<h2>Configurando o banco de dados no arquivo .env</h2>

<p>
	Crie um banco de dados Mysql no seu localhost (nome do banco de sua preferência)
</p>

<p>
	Após criar o banco atualize as informações do seu banco no arquivo .env com as seguintes configurações:<br/><br/>
	
	DB_CONNECTION=mysql<br/>
	DB_HOST=127.0.0.1<br/>
	DB_PORT=3306<br/>
	DB_DATABASE={nome-do-banco}<br/>
	DB_USERNAME=root<br/>
	DB_PASSWORD={senha-se-necessario}<br/>

</p>
<p>
	Agora vamos limpar o seu arquivo de configuração usando o comando: 'php artisan config:clear'
</p>
<p>
	com o banco de dados criado e o .env atualizado abra o seu terminal setado para a pasta do seu projeto e execute o comando: 'php artisan migrate', observe que as suas tabelas vão ser criadas utilizando a função migrate do laravel
</p>

<p>
   Aproveitado que o seu terminal esta aberto execute o comando 'php artisan serve', veja que vai exibir o link no qual o seu backend esta rodando, deixe o rodando e vamos para configuração do front end
   <a href="https://github.com/Schielke-code/ApiProdutosFrontend" target="_blank">clicando aqui</a>
</p>
