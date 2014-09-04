<?php $this->load->view('layout/head'); ?>
<?php $this->load->view('layout/header'); ?>
<h3>Listado comentarios destacados(Mayor número de respuestas)</h3>
<div class="right">
    <?php echo anchor('comentarios/crear_comentario', 'Crear Comentario', array('class' => 'btn btn-primary')) ?>    
</div>

<ul>
    <?php foreach ($comentarios as $datos): ?>
        <li>
            <span class="glyphicon glyphicon-comment"></span> <?php echo $datos->texto ?>  
            <div class="opciones">
                <span class="label" style="background: <?php echo $datos->color ?>">
                    Temática: <?php echo $datos->tematica ?></span>
                <?php echo anchor('comentarios/lista_respuestas/' . $datos->id, 'Ver Respuestas (' . $datos->counter . ')', array('class' => 'btn btn-primary btn-opciones'))
                ?>
                <?php echo anchor('comentarios/agregar_respuesta/' . $datos->id, 'Responder ', array('class' => 'btn btn-success btn-opciones'))
                ?>  
            </div>

        </li>
    <?php endforeach ?>  
</ul>
<?php $this->load->view('layout/footer'); ?>