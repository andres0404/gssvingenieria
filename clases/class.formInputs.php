<?php
/**
 * biblioteca campo de formularios
 */
class FormInput{
    
    /**
     * Bloque ayuda para todos los campos
     * @param type $ayuda
     * @return type
     */
    private static function _bloqueAyudaBajo($ayuda = ''){
        return (empty($ayuda) ? '' : ( '<p class="help-block">'.$ayuda.'</p>'));
    }
    /**
     * @param type $nameValor
     * @param type $nombre
     * @param type $valor
     * @param type $placeholder si es true sera nombre a $nombre, false no aparecera. En caso de ser texto sera texto de placeholder
     * @param type $ayuda
     * @return string
     */
    public static function campoTexto($nameValor,$nombre = '',$valor = '',$placeholder = true,$ayuda = ''){
        $placeholder = $placeholder === true ? ( 'placeholder="'.$nombre.'"') : ( !empty($placeholder) ? ( 'placeholder="'.$placeholder.'"') : '' );
        $html = '<div class="form-group">';
        $html .= (empty($nombre) ? '' : ( '<label>'.$nombre.'</label>'));
        $html .= ( '<input class="form-control" '.$placeholder.' name="'.$nameValor.'" id="'.$nameValor.'" value="'.$valor.'">');
        $html .= self::_bloqueAyudaBajo($ayuda);
        $html .= '</div>';
        return $html;
    }
    /**
     * Campo oculto (hidden)
     * @param type $nameValor
     * @param type $valor
     * @return string
     */
    public static function campoOculto($nameValor, $valor){
        $html = '<input type="hidden" name="'.$nameValor.'" id="'.$nameValor.'" value="'.$valor.'" />';
        return $html;
    }
    /**
     * Campo de texto desactivado
     * @param type $nameValor
     * @param type $nombre
     * @param type $valor
     * @param type $placeholder
     * @param type $ayuda
     */
    public static function campoTextoApagado($nameValor,$nombre = '',$valor = '',$placeholder = true,$ayuda = ''){
        $html = '<div class="form-group">';
        $html .= (empty($nombre) ? '' : ( '<label>'.$nombre.'</label>'));
        $html .= ('<input class="form-control" value="'.$valor.'" id="'.$nameValor.'" name="'.$nameValor.'" type="text" placeholder="'.$placeholder.'" disabled>');
        $html .= ('<input type="hidden" name="'.$nameValor.'" id="'.$nameValor.'" value="'.$valor.'" />');
        $html .= self::_bloqueAyudaBajo($ayuda);
        $html .= '</div>';
        return $html;
    }
    /**
     * Campo para mostrar valor no editable. Incluye hidden con valor mostrado
     * @param type $nameValor
     * @param type $nombre
     * @param type $valor
     */
    public static function campoEstatico($nameValor,$nombre = '',$valor = ''){
        $html = '<div class="form-group">';
        $hmtl .= empty($nombre) ? '' : ( '<label>'.$nombre.'</label>');
        $html .= ( '<p class="form-control-static">'.$valor.'<input type="hidden" name="'.$nameValor.'" value="'.$nameValor.'"></p>');
        $html .= '</div>';
        return $html;
    }
    /**
     * input text
     * @param type $nameValor nombre de atributos id y name
     * @param type $nombre label del campo
     * @param type $valor
     * @param type $placeholder
     * @param type $ayuda
     * @return string
     */
    public static function campoAreaTexto($nameValor,$nombre = '',$valor = '',$placeholder = true,$ayuda = ''){
        $placeholder = $placeholder === true ? ( 'placeholder="'.$nombre.'"') : ( !empty($placeholder) ? ( 'placeholder="'.$placeholder.'"') : '' );
        $html = '<div class="form-group">';
        $html .= (empty($nombre) ? '' : ( '<label>'.$nombre.'</label>'));
        $html .= ( '<textarea class="form-control" rows="3" '.$placeholder.' name="'.$nameValor.'" id="'.$nameValor.'">'.$valor.'</textarea>');
        $html .= self::_bloqueAyudaBajo($ayuda);
        $html .= '</div>';
        return $html;
    }
    /**
     * Boton
     * @param type $label
     * @param type $tipoBoton 1: submit, 2: button 3: reset
     * @return string
     */
    public static function button($label, $tipoBoton = 1, $opciones = ''){
        $type = $tipoBoton == 1 ? 'submit' : $tipoBoton == 2 ? 'button' : 'reset';
        $html = '<button type="'.$type.'" class="btn btn-default" '.$opciones.' >'.$label.'</button>';
        return $html;
    }
    /**
     * Canpo chequeo
     * @param string $nameValor string en el atributo name
     * @param string $idValor string en el atributo id
     * @param string $nombre Valor del label del campo
     * @param string $valor string en el atributo value
     * @return string
     */
    public static function campoChequeo($nameValor, $idValor, $nombre = '', $valor = '', $chequeado = false){
        $chequeado = $chequeado == false ? '' : 'checked="checked"';
        $html = '<div class="checkbox"><label><input type="checkbox" value="'.$valor.'" id="'.$idValor.'" name="'.$nameValor.'" '.$chequeado.' >'.$nombre.'</label></div>';
        return $html;
    }
    /**
     * Campo radio buuton
     * @param string $nameValor string en el atributo name
     * @param string $idValor string en el atributo id
     * @param string $nombreCombo Nombre del conjunto de botones radio
     * @param string $valores Valores de los botones radio: array(valor => label)
     * @param type $chequeado Incluir el valor del campo a chequear
     */
    public static function campoRadioEnLinea($nameValor, $idValor, $nombreCombo = '', $valores = array(), $chequeado = ''){
        $html = '<div class="form-group"><label>'.$nombreCombo.'</label> ';
        $aux = array();
        foreach($valores as $valor => $label){
            $aux[] = '<label class="radio-inline"><input id="'.$valor.'_'.$idValor.'" type="radio" '.($chequeado == $valor ? 'checked=""':'').' value="'.$valor.'" name="'.$nameValor.'">'.$label.'</label>';
        }
        $html .= implode("", $aux);
        $html .= '</div>';
        return $html;
    }
    /**
     * Campo de seleccion
     * @param type $nameValor
     * @param type $idValor
     * @param type $nombre
     * @param type $valores
     * @param string $valSeleccionado valor seleccionado en el campo
     * @param type $chequeado
     * @return string
     */
    public static function campoSeleccion($nameValor, $nombre = '', $valores = array(), $valSeleccionado = '', $ayuda = ''){
        $html = '<div class="form-group">';
        $html .= (empty($nombre) ? '' : ( '<label>'.$nombre.'</label>'));
        $html .= ('<select class="form-control" name="'.$nameValor.'" id="'.$nameValor.'">');
        foreach($valores as $valor => $label){
            $selected = '';
            if($valor == $valSeleccionado){
                $selected = 'selected="selected"';
            }
            $html .= ('<option value="'.$valor.'" '.$selected.' >'.$label.'</option>');
        }
        $html .= '</select>';
        $html .= self::_bloqueAyudaBajo($ayuda);
        $html .= '</div>';
        return $html;
    }
    
    
    
}