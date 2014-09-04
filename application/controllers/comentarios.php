<?php

/*
 * THE MIT LICENSE
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * <http://jaimebravo.co>.
 */
?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Comentario
 * 
 * Controlador de la entidad Comentario
 * 
 * @category  Controller Class
 * @author    Jaime Bravo <developer@jaimebravo.co>
 * @copyright Copyright (c) 2014
 * @license   MIT
 * @version   1.1
 */
class Comentarios extends CI_Controller {

    /**
     * Método constructor
     * 
     * Se carga el modelo el modelo que se usa por defecto.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Comentario');
    }

    /**
     *  Inicio de la aplicación
     * 
     * Se carga la información con los comentarios relevantes. 
     */
    public function index() {
        $this->load->helper('MY_general_helper');
        $datos_vista['titulo'] = 'Listado de Comentarios';
        $datos_vista['comentarios'] = $this->Comentario->lista_comentarios();
        $this->load->view('comentarios/lista_comentarios', $datos_vista);
    }

    /**
     * Guarda los nuevos comentarios.
     */
    public function crear_comentario() {
        $this->load->library('form_validation');
        $datos_vista['titulo'] = 'Crear un comentario';
        $datos_vista['tematicas'] = $this->Comentario->lista_tematicas();
        if ($_POST) {
            $this->form_validation->set_rules('comentario', 'Comentario', 'required|is_unique[comentarios.texto]');
            $this->form_validation->set_message('required', 'El comentario es requerido');
            $this->form_validation->set_message('is_unique', 'Este comentario ya ha sido publicado');
            if ($this->form_validation->run() == FALSE) {

                $this->load->view('comentarios/crear_comentario', $datos_vista);
            } else {
                $datos = array('texto' => $this->input->post('comentario'),
                    'tematica_id' => $this->input->post('tematica'));
                $guardar_datos = $this->Comentario->crear_comentario($datos);
                if ($guardar_datos) {
                    $datos_vista['mensaje'] = 'Se ha publicado el comentario';
                    $this->load->view('comentarios/crear_comentario', $datos_vista);
                }
            }
        } else {

            $this->load->view('comentarios/crear_comentario', $datos_vista);
        }
    }

    /**
     * Listado de respuestas conforme al comentario.
     * 
     * @param Int $id
     */
    public function lista_respuestas($id) {
        $datos_vista['titulo'] = 'Respuestas';
        $datos_vista['respuestas'] = $this->Comentario->lista_respuestas($id);
        $datos_vista['comentario'] = $this->Comentario->comentario_detalle($id);
        $this->load->view('comentarios/lista_respuestas', $datos_vista);
    }
/**
 *  Agrega una nueva respuesta
 * 
 * @param Int $comentario_id
 */
    public function agregar_respuesta($comentario_id = NULL) {
        $this->load->library('form_validation');
        $datos_vista['titulo'] = 'Responder Comentario';

        if ($_POST) {
            $this->form_validation->set_rules('respuesta', 'Respuesta', 'required|is_unique[respuestas.texto]');
            $this->form_validation->set_message('required', 'El Texto respuesta es requerido');
            $this->form_validation->set_message('unique', 'Esta respuesta ya ha sido enviada, intenta con otra');
            if ($this->form_validation->run() == FALSE) {
                $datos_vista['comentario_id'] = $this->input->post('comentario_id');
                $this->load->view('comentarios/agregar_respuesta', $datos_vista);
            } else {
                $datos = array('texto' => $this->input->post('respuesta'),
                    'comentarios_id' => $this->input->post('comentario_id'));
                $guardar_respuesta = $this->Comentario->guardar_respuesta($datos);
                if ($guardar_respuesta) {
                    redirect('/comentarios/lista_respuestas/' . $this->input->post('comentario_id'), 'refresh');
                }
            }
        } else {
            $datos_vista['comentario_id'] = $comentario_id;
            $this->load->view('comentarios/agregar_respuesta', $datos_vista);
        }
    }

}

