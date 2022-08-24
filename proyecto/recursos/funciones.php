<?php

function refrezcar($archivo)
{
    header("Location: $archivo");
}

$script_alerta = "";

function alerta($titulo, $texto, $icono)
{
    return "swal({
        title: '$titulo',
        text: '$texto',
        icon: '$icono',
    })";
}