# API-REST-COMPRAS

## ✨ Recursos:
- [x] Mysql;
- [x] Ubuntu;
- [x] Crud;
- [x] Codeigniter 4;
- [x] ApiRest

## 💻 Requisitos:

Antes de começar :checkered_flag:, você precisa ter o [Apache](https://httpd.apache.org/download.cgi), [PHP](https://www.php.net/downloads.php),[composer](https://getcomposer.org) 
```
-Abra o terminal e execute o seguinte comando para instalar o CodeIgniter 4 globalmente: composer global require codeigniter4/framework;
-por via  das dúvidas verifique se o codeigniter foi instalado corretamente com o comando :codeigniter --version

-é importante dizer que  para ter todas as dependencias atualizada utilize  o comando:  composer update.

- clone esse projeto
 $ git clone https://github.com/robertferrei/API-REST-Compras.git
```

## 🚀 Tecnologias:

As seguintes ferramentas foram usadas neste projeto:


- [PHP]()  
- [UBUNTU]() 
- [MIGRATIONS]()
- [CONTROLLER]()
- [CODEIGNITER]()
- [ORM]()
  
## :checkered_flag: Início


```bash
#Rodar este projeto

é necessario abrir a pasta public Ex: ~/cadastro_pedidos/Pedidos_compras/public

depois de acessar a pasta public escreva o comando: php -S localhost:8000

Atualize as variáveis de ambiente do arquivo .app.Config.Database
```dosini
 public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];
```
```bash
#rodar migrations

//Depois de conectar Seu banco de dados é importante estar fazendo as migrations para que as tabelas sejam inseridas 

-Comando: php spark migrate
-Status: php spark migrate:status
```

```bash
#relacionamento Tabelas
OBS: a tabela não tem todos os campos da imagem
```
![relacionamento tabelas](https://github.com/robertferrei/API-REST-Compras/assets/126025896/ddddee72-4398-44e0-97ac-3e3bcc721357)


```
Exemplos de tabela clientes
| Parâmetro   | Tipo      | Descrição                        |
| :---------  | :-------  | :------------------------------- |
| `nome_razao`| `VARCHAR` | **Obrigatório/Unico** Nome unico |
| `cpf_cnpj`  | `VARCHAR` | **Obrigatório** CPF Unico        |

```

```
Exemplos de tabela Item pedidos
| Parâmetro    | Tipo  | 
| :---------   | :-------  
| `pedido_id`  | `INT` | 
|`produto_id`  | `INT` | 
|`quantidade`  | `INT` |   

```

```
Exemplos de tabela  pedidos
| Parâmetro     | Tipo     | 
| :---------    | :-------  
| `cliente_id`  | `INT`    | 
| `status`      | `ENUM`   | 
| `total`       | `DOUBLE` |   

```

```
Exemplos de tabela  Produtos
| Parâmetro     | Tipo     | 
| :---------    | :-------  
| `descricao`   | `VARCHAR`| 
| `valor`       | `DOUBLE` | 
   
```


### Resposta de Exemplo GET:
![image](https://github.com/robertferrei/API-REST-Compras/assets/126025896/dd7ebca7-f6bb-48c9-9205-50326513a6e3)

### Resposta de Exemplo GET/ID:
![image](https://github.com/robertferrei/API-REST-Compras/assets/126025896/39f0da24-8528-4438-9210-1846c3c22533)

### Resposta de Exemplo POST:
![image](https://github.com/robertferrei/API-REST-Compras/assets/126025896/249919a5-0cec-495b-88e0-4c8fc7880aa9)

### Resposta de Exemplo DELETE:
![image](https://github.com/robertferrei/API-REST-Compras/assets/126025896/72204abe-d453-4003-85de-bc27742d8243)



