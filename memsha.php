<?php



/**
*	Accede a la memoria compartida y obten su contenido
*	$id => Identificador que el sistema utilizará para ese segmento de memoria compartida 
*	return Error array() | return true
*/

function openSM($msj,$id)
{
	
	$typeMsj=serialize($msj); // serializa el mensaje para enviarlo
	$msjSize = strlen($typeMsj); // Obtiene el tamaño de el mensaje serializado 

	// Cramos la memoria compartido en modo escritura con la letra "c"
	$shared_id = @shmop_open($id,"c",0644,$msjSize); // se coloca el @ para que esa funcion no genere un error


	// se verifica si se creo correctamente la memoria compartida 
   if(!$shared_id)
   {
        return ["Error: Al crear la memoria compartida"];
   }
   else
   {
   		// Verifica que se haya escrito en la memoria
   		if($msjSize != @shmop_write($shared_id, $typeMsj, 0))
        {
           	shmop_close($shared_id); // Solo cierra el segmento de memoria compartida no lo borra
            return ["Error: Al intentar escribir en el segmento de memoria"];
        }
        else
        {
            shmop_close($shared_id);
        	return true;
        }

   }


}




/**
*	Accede a la memoria compartida y obten su contenido
*	$id => Identificador que el sistema utilizará para ese segmento de memoria compartida 
*	return Error array | return $share_data
*/

function getSM($id)
{

   //Abrimos la memoria en modo lectura con la letra "a" compartida con el id
    $shared_id = @shmop_open($id,"a",0666,0); // tambien funciona poniendo $id,"a",0,0
    
	if (!empty($shared_id))
	{

   		$share_data = @shmop_read($shared_id,0,shmop_size($shared_id));
	    
	    //Marcamos el bloque para que sea eliminado y lo cerramos
	    shmop_delete($shared_id); // esta funcion retorna un bool, se podria ferificar si la memoria se cerro;
	    shmop_close($shared_id);
	    return unserialize($share_data);

	}
	else 
	{
		return ["Error: El identificador [ ".$id." ] que se uso para el segmento de memoria no existe"];
	}

}


$id= getmypid();
print_r($id);

# DIFERENTE TIPO DE GUARDADO DE DATOS
//openSM(["jose"=>"hombre","perro"=>"pitbull"],$id);
//openSM("aasdasda)",$id);

openSM('{"nombre":"jose","perro":"Bull terrier"}',$id);

print_r( getSM($id) ); 
echo "\n";







?>