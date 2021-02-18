# Project Machine Monitor - Bootstrap, PDO & MySQL
This application is a front-end for a bank where information about the status of registered machines is stored.

## How it works:

Two parts were developed for this application, one being the PHP front-end as requested, and the other in Python. The Python code contains a function that creates an SSH connection on the machine in question, and executes some commands to obtain the answers required in the test.
As a point of observation, the target machine must have the monitoring machine's public key in its ~ / .ssh / known_hosts file. This part is required for a connection without the need for a password.
## Configuration:

- Edit file **database.php** 

```
$dbNome = 'nomeDaTable' 
$dbHost = 'nomeDoDominioOuIP:Porta' 
$dbUsuario = 'usuarioDoMysql' 
$dbSenha 'senhaDoUsuario'

```

![List Machines](https://github.com/felipecc/monitor_machine/blob/main/img/list_machines.PNG)
![Add Machine](https://github.com/felipecc/monitor_machine/blob/main/img/add_machine.PNG)
![Log Machine](https://github.com/felipecc/monitor_machine/blob/main/img/log_machine.PNG)
![Filter Machine](https://github.com/felipecc/monitor_machine/blob/main/img/filter_example.PNG)

