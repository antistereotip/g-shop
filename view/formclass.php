<?php



class EshopUpdateForm {
	
    function __construct( $fields = array()){
		
    }
	
    function render_form( $fields = array() , $form_atts = 
        array('action'=>'','name'=>'', 'method' => 'get')){	
	$output = '';
	foreach( $fields as $field ){
            if($field['type'] == 'text'){
		$output.= $this->text($field);
            }
            if($field['type'] == 'textarea'){
		$output.= $this->textarea($field);
            }
            if($field['type'] == 'select'){
		$output.= $this->select($field);
            }
            if($field['type'] == 'hidden'){
		$output.= $this->hidden($field);
            }
	}	
	$output = $this->wrap_form( $output , $form_atts);
	echo $output;	
    }
    
    function wrap_form( $content ='' , $atts = ''){
	$output = '';
	$name = '';
	if($atts!=''){
            $inline_atts = '';
            foreach($atts as $key => $value){
                $inline_atts.= $key . '="'.$value.'"';
            }
	}	
	$output.= '<form '.$inline_atts. ' >'."\n";
	$output.= $content;
	$output.= '<input type="submit" name="submit" '
                . 'class="button btn btn-primary"/>'."\n";
	$output.='</form>'."\n";  
	return $output;		
    }
    
    function text( $field, $type = 'text'){
        $output = '';
        $output.= '<div class="row">'."\n";
        $output.= '<div class="columns large-12">'."\n";
        $output.= '<label for="'.$field['name'].'">'."\n";
        $output.= $field['label']."\n";
        $output.= '</label>'."\n";
        $output.= '<input type="'.$type.'" value="'.$field['value'].'" '
               . 'name="'.$field['name'].'" id="'.$field['name'].'"/>'."\n";
        if(isset($field['error']) && !empty($field['error'])){
        $output.= '<small class="error">'.$field['error'].'</small>'."\n";	
        }
        $output.= '</div>'."\n";
        $output.= '</div>'."\n";
        return $output;	
	}
	/* function single( $field, $type = 'single'){
		
		$output = '';
		$output.= "\t".'<div class="row">'."\n";
		$output.= "\t"."\t".'<div class="columns large-12">'."\n";
		$output.= "\t"."\t"."\t".'<p>'.$field['value'].'</p>'."\n";	
		$output.= "\t"."\t".'</div>'."\n";
		$output.= "\t".'</div>'."\n";
		
		return $output;
		
		
	} */

	
    function textarea( $field, $type = 'textarea'){
		
	$output = '';
	$output.= '<div class="row">'."\n";
	$output.= '<div class="columns large-12">'."\n";
	$output.= '<label for="'.$field['name'].'">'."\n";
	$output.= $field['label']."\n";
	$output.= '</label>'."\n";
	$output.= '<textarea  name="'.$field['name'].'" '
               . 'id="'.$field['name'].'">'.$field['value'].'</textarea>'."\n";
	if(isset($field['error']) && !empty($field['error'])){
	$output.= '<small class="error">'.$field['error'].'</small>'."\n";	
	}
	$output.= '</div>'."\n";
	$output.= '</div>'."\n";
	return $output;			
	}
        
    function select($field){
        $output = '';
        $output.= '<div class="row">'."\n";
        $output.= '<div class="columns large-12">'."\n";
        $output.= '<select name="'.$field['name'].'">';
        foreach($field['options'] as $key => $option){
            if($field['value'] == $key){
                $selected = 'selected="selected"';
            }else{
                $selected = '';
            }
            $output.= '<option value="'.$key.'" '.$selected.'>'.$option.'</option>';
        }
        $output.= '</select>'."\n";
        $output.= '</div>'."\n";
        return $output;
    }
	
    function hidden( $field ){
        //za theme value ce biti theme a name package_type 
        //za plugin value plugin a name package_type
        return '<input type="hidden" value="'.$field['value'].'" '
               . 'name="'.$field['name'].'"/>'."\n";  
        }
	
}

?>
