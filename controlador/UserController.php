<?php
include_once '../modelo/usuario.php';
$usuario = new Usuario();
if ($_POST['funcion']== 'buscar_usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_años = $edad->y;
        $json[]= array(
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_años,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us

        );
    }      
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if ($_POST['funcion']== 'capturar_datos') {
    $json = array();
    $id_usuario=$_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[]= array(
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us

        );
    }      
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if ($_POST['funcion']=='editar_usuario') {
    $id_usuario=$_POST['id_usuario'];
    $telefono=$_POST['telefono'];
    $residencia=$_POST['residencia'];
    $correo=$_POST['correo'];
    $sexo=$_POST['sexo'];
    $adicional=$_POST['adicional'];
    $usuario->editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);      
    echo 'editado';
}
if ($_POST['funcion']=='cambiar_contraseña') {
    $id_usuario=$_POST['id_usuario'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $usuario -> cambiar_contraseña($id_usuario,$oldpass,$newpass);

}
?>