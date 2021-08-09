# Memoria Compartida

Comparte datos por medio de un segmento que se crea en la memoria y accede a los datos con el identificador asignado , 
es muy utilizado al usar procesos [Fork](https://www.php.net/manual/en/function.pcntl-fork.php) en php.
documentacion oficial de la [Memoria Compartida](https://www.php.net/manual/en/ref.shmop.php)




### Ejemplo de uso:

```sh
// numero de segmento de memoria, no importa el numero pero si se usa procesos es mejor identificarlos con el PID
$id= getmypid(); 

// Puedes almacenar cualquier tipo de datos [JSON , ARRAY, OBJECT, STRING, NUMERIC]
openSM('{"nombre":"jose","perro":"Bull terrier"}',$id);

// Extrae la informacion con la funcion getSM y el identificador
print_r( getSM($id) );  
```


## Contribuir
Encontraste un error? por favor de publicarlo en [issue tracker](https://github.com/CR0NYM3X/Memoria-Compartida-PHP/issues).
