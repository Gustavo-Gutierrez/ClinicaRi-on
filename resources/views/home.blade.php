@extends('adminlte::page')

@section('title', 'Dashboard')
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Consulta</title>
@section('content_header')
<h1>Formulario de Consulta</h1>
@stop

@section('content')
<style>
    .custom-form {
        max-width: 100%; /* Define el ancho máximo del formulario */
        margin: 0 auto; /* Centra el formulario en el centro de la página */
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
<body>
        <label for="nombre">Nombre del paciente:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="integer" id="telefono" name="telefono" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="fecha_consulta">Fecha de la consulta:</label>
        <input type="date" id="fecha_consulta" name="fecha_consulta" required><br>

        <div style="display: flex; align-items: flex-start;">
        <label for="historia_clinica">Resumen historia clínica y examen físico:</label>
        <div style="margin-left: 10px;">
        <textarea id="historia_clinica" name="historia_clinica" rows="4" required></textarea><br>
        </div>
        </div>

        <label for="nefropatia">Nefropatía:</label>
        <input type="text" id="nefropatia" name="nefropatia"><br>

        <label for="grupo_sanguineo">Grupo Sanguíneo ABO:</label>
        <input type="text" id="grupo_sanguineo" name="grupo_sanguineo"><br>

        <label for="virus_hepatitis_b">VHB (Fecha):</label>
        
        <input type="text" id="virus_hepatitis_b" name="virus_hepatitis_b">
        <input type="date" id="virus_hepatitis_b" name="virus_hepatitis_b"><br>

        <label for="virus_hepatitis_c">VHC (Fecha):</label>
        <input type="text" id="virus_hepatitis_c" name="virus_hepatitis_c">
        <input type="date" id="virus_hepatitis_c" name="virus_hepatitis_c"><br>

        <label for="vih">VIH (Fecha):</label>
        <input type="text" id="vih" name="vih">
        <input type="date" id="vih" name="vih"><br>

        <label for="cmv">CMV (Fecha):</label>
        <input type="text" id="cmv" name="cmv">
        <input type="date" id="cmv" name="cmv"><br>

        <label for="ebv">EBV (Fecha):</label>
        <input type="text" id="ebv" name="ebv">
        <input type="date" id="ebv" name="ebv"><br>

        <label for="fecha_dialisis">Fecha 1ª Diálisis:</label>
        <input type="date" id="fecha_dialisis" name="fecha_dialisis"><br>

        <label for="vacunas">Vacunas:</label>
        <input type="text" id="vacunas" name="vacunas"><br>

        <label for="grupo_donante">Grupo Sanguíneo del Donante:</label>
         <select id="grupo_donante" name="grupo_donante">
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
     <option value="O-">O-</option>
<       </select>
        <br>

        <label for="tipo_donante">Tipo del Donante:</label>
        <input type="radio" id="vivo" name="tipo_donante" value="vivo">
        <label for="vivo">Vivo</label>
        <input type="radio" id="cadaver" name="tipo_donante" value="cadaver">
        <label for="cadaver">Cadáver</label>
        <br>

        

        <label for="causa_obito">Causa del Óbito:</label>
        <input type="text" id="causa_obito" name="causa_obito"><br>

        <label for="hla">Histo compatibilidad HLA:</label>
        <input type="text" id="hla" name="hla"><br>

        <div style="display: flex; align-items: flex-start;">
        <label for="lista_problemas" style="margin-top: 8px;">Lista de Problemas (Fecha):</label>
        <div style="margin-left: 10px;">
        <textarea id="lista_problemas" name="lista_problemas" rows="4" required></textarea>    
            </div>
            <label for="fecha_lista_problemas"style="margin-top: 8px;">Fecha:</label>
            <input type="date" id="fecha_lista_problemas" name="fecha_lista_problemas"><br>
        </div>
        

        <button type="submit">Guardar Consulta</button>
    
</body>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop