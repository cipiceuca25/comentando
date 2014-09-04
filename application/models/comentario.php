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
 * Contiene toda la logica de Comentario
 * 
 * @category  Database Model
 * @author    Jaime Bravo <developer@jaimebravo.co>
 * @copyright Copyright (c) 2014
 * @license   MIT
 * @version   1.1
 *  */
class Comentario extends CI_Model {

    /**
     * Método constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * Metodo para listar los comentarios organizados del mayor
     * a menor numero de respuestas.
     * 
     * @return Obj
     */
    public function lista_comentarios() {
        $datos = $this->db->query('SELECT id, texto, tematica, color, counter
     FROM ( SELECT comen.id, comen.texto, t.nombre as tematica, t.color AS color, COUNT(res.id) AS counter
     FROM comentarios comen ,respuestas res, tematica t
     WHERE res.comentarios_id = comen.id
     AND t.id = comen.tematica_id
     GROUP BY comen.id, comen.texto
     ORDER BY counter DESC ) x LIMIT 10');
        return $datos->result();
    }

    /**
     * Método para listar la tematicas en el dropdown HTML
     * 
     * @return Array
     */
    public function lista_tematicas() {
        $this->db->select('id, nombre')->from('tematica');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    /**
     * 
     * Crear nuevos comentarios
     * 
     * @param Array $datos
     * @return Obj
     */
    public function crear_comentario($datos) {
        return $this->db->insert('comentarios', $datos);
    }

    /**
     *  Método para lista las respuestas por comentario. 
     * 
     * @param Int $comentario_id
     * @return Obj
     */
    public function lista_respuestas($comentario_id) {
        $this->db->select('respuestas.id, respuestas.texto');
        $this->db->from('respuestas');
        $this->db->where('comentarios_id', $comentario_id);
        $consulta = $this->db->get();
        return $consulta->result();
    }

    /**
     *  Ver el detalle del comentario.
     * 
     * @param Int $comentario_id
     * @return Obj
     */
    public function comentario_detalle($comentario_id) {
        $this->db->select('comentarios.texto');
        $this->db->from('comentarios');
        $this->db->where('id', $comentario_id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->texto;
        }
    }

    /**
     * Guarda la información de nuevas respuestas.
     * 
     * @param Array $datos
     * @return Obj
     */
    public function guardar_respuesta($datos) {
        return $this->db->insert('respuestas', $datos);
    }

}
?>