<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

require_once '../models/DisciplinaModel.php';

$id_disciplina = $_GET['disciplina'] ?? null;

if (!$id_disciplina || !is_numeric($id_disciplina)) {
    die("ID de disciplina no válido.");
}

$model = new DisciplinaModel();
$socios = $model->getSociosPorDisciplina($id_disciplina);
$nombreDisciplina = $model->getNombreDisciplina($id_disciplina);

require_once '../views/listar_disciplina.php';
