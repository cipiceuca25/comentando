<?php $this->load->view('layout/head'); ?>
<?php $this->load->view('layout/header'); ?>
<h3>Respuestas</h3>
<blockquote>
    <p><span class="glyphicon glyphicon-comment"></span> <?php echo $comentario ?></p>  
</blockquote>

<ul>
    <?php foreach ($respuestas as $res): ?>
        <li class="bg-success">
            <span class="glyphicon glyphicon-hand-right"></span> <?php echo $res->texto ?>  
        </li>
    <?php endforeach ?>  
</ul>
<?php echo anchor('comentarios', 'Regresar', array('class' => 'btn btn-primary')) ?>
<?php $this->load->view('layout/footer'); ?>
