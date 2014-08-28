<?php
class Mycal_model extends CI_Model{
    var $conf;
    function __construct() {
        
        parent::__construct();
         $this->conf=array(
            'start_day'=>'monday',
            'show_next_prev'=>TRUE,
            'next_prev_url'=> base_url().'mycal/display'
        );
        $this->conf['template']='  
                    {table_open}<table class="calendar" >{/table_open}

                    {heading_row_start}<tr>{/heading_row_start}

                    {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                    {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                    {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

                    {heading_row_end}</tr>{/heading_row_end}

                    {week_row_start}<tr>{/week_row_start}
                    {week_day_cell}<td>{week_day}</td>{/week_day_cell}
                    {week_row_end}</tr>{/week_row_end}

                    {cal_row_start}<tr class="days">{/cal_row_start}
                    {cal_cell_start}<td class="day">{/cal_cell_start}

                    {cal_cell_content}
                        <div class="day_num">{day}</div>
                        <div class="content">{content}</div>
                    {/cal_cell_content}
                    
                    {cal_cell_content_today}
                        <div class="day_num highlight">{day}</div>
                        <div class="content">{content}</div>
                    {/cal_cell_content_today}

                    {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
                    {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

                    {cal_cell_blank}&nbsp;{/cal_cell_blank}

                    {cal_cell_end}</td>{/cal_cell_end}
                    {cal_row_end}</tr>{/cal_row_end}

                    {table_close}</table>{/table_close}';
    }

    function get_calendar($ano,$mes){
        $query = $this->db->select('fecha,eventos')->from('calendar.calendario')
                ->like('fecha',"$mes/$ano")->get();
        $call_data= array();
        foreach($query->result() as $row){
            $call_data[substr($row->fecha,0,2)]=$row->eventos;
        }
        return $call_data;
    }
    function set_calendar($fecha,$eventos){
        
        if($this->db->select('fecha')->from('calendar.calendario')
                ->where('fecha',$fecha)->count_all_results())
        {
            $this->db->where('fecha',$fecha)
                    ->update('calendar.calendario',array(
                    'fecha'=>$fecha,
                    'eventos'=>$eventos
            ));
        }else{
            $this->db->insert('calendar.calendario',array(
                'fecha'=>$fecha,
                'eventos'=>$eventos
            ));
        }
    }
            
    function generate($ano,$mes){
        $this->load->library('calendar',  $this->conf);
        $this->set_calendar('17/03/2014','mas y mas mas vladis');
        $call_data = $this->get_calendar($ano, $mes);      
        return $this->calendar->generate($ano,$mes,$call_data);
    }
}

