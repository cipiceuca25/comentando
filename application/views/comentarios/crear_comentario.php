<?php $this->load->view('layout/head', $titulo); ?>
<?php $this->load->view('layout/header'); ?>
<h3>Crear Comentario</h3>
<?php
if (isset($mensaje)) {
    echo $mensaje; //mensaje de success
}
?>
<?php echo validation_errors(); // mensajes de validación?>
<?php
$atrib = array('name' => 'crear_comentario',
    'id' => 'crear_comentario');
echo form_open('comentarios/crear_comentario', $atrib)
?>

<?php echo form_label('Escribe tu Comentario', 'comentario', array('class' => 'control-label')); ?>
<?php
$com_atrib = array(
    'name' => 'comentario',
    'id' => 'comentario',
    'class' => 'form-control'
);
echo form_textarea($com_atrib);
?>
    <?php echo form_label('Selecciona la Temática', 'tematica', array('class' => 'control-label')); ?>

<select name="tematica" id="tematica" class="form-control">
    <?php
    foreach ($tematicas as $row) {
        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>'; //carga del select
    }
    ?>
</select>

<?php echo form_submit('crear_comentario', 'Crear Comentario', 'class="btn btn-success"'); ?>
<?php echo form_close() ?>
<?php echo anchor('comentarios', 'Regresar', array('class' => 'btn btn-primary btn-opciones')) ?>
<?php $this->load->view('layout/footer'); ?>