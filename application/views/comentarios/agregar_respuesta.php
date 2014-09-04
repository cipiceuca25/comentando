<?php $this->load->view('layout/head', $titulo); ?>
<?php $this->load->view('layout/header'); ?>
<h3>Agregar Respuesta</h3>
<?php
if (isset($mensaje)) {
    echo $mensaje;
}
?>
<?php echo validation_errors(); // mensajes de validación?>
<?php
$atrib = array('name' => 'agregar_respuesta',
    'id' => 'agregar_respuesta');
echo form_open('comentarios/agregar_respuesta', $atrib)
?>

<?php echo form_label('Escribe tu respuesta', 'respuesta', array('class' => 'control-label')); ?>
<?php
$com_atrib = array(
    'name' => 'respuesta',
    'id' => 'respuesta',
    'class' => 'form-control'
);
echo form_textarea($com_atrib);
?>
<?php echo form_hidden('comentario_id', $comentario_id) ?>
<?php echo form_submit('enviar_respuesta', 'Enviar Respuesta', 'class="btn btn-success"'); ?>
<?php echo form_close() ?>
<?php echo anchor('comentarios/lista_respuestas/' . $comentario_id, 'Regresar', array('class' => 'btn btn-primary btn-opciones')) ?>
<?php $this->load->view('layout/footer'); ?>

