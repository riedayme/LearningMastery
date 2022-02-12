<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Pages extends CI_Model
{

    public $table_site_pages = 'tb_site_pages';    

    public function datatables(){

        $url = base_url('app/site_pages/');

        return [
            'datatable' => true,
            'datatables_data' => "
            [{'data': 'checkbox',className:'c-table__cell u-pl-small'},
            {'data': 'id',className:'c-table__cell'},
            {'data': 'title',className:'c-table__cell u-pl-small',width:'100%'},
            {'data': 'time',className:'c-table__cell'},            
            {'data': 'updated',className:'c-table__cell'},
            {'data': 'view',className:'c-table__cell'},            
            {'data': 'alat',className:'c-table__cell'}
            ]
            ",
        ];        
    }    

    public function data_table(){

        header('Content-Type: application/json');        

        $this->datatables->select('
            tb_site_pages.id,
            tb_site_pages.title,
            DATE_FORMAT(tb_site_pages.time, "%d %M %Y %H:%i %p") as time,
            DATE_FORMAT(tb_site_pages.updated, "%d %M %Y %H:%i %p") as updated,            
            tb_site_pages.permalink,
            tb_site_pages.status,  
            ');
        $this->datatables->from($this->table_site_pages);
        $this->datatables->add_column('checkbox', '
            <td>
            <div class="c-choice c-choice--checkbox">
            <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
            <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
            </div>
            </td>
            ', 'id');

        $this->datatables->edit_column('title', '
            <a title="$4" href="' . base_url('p/'). "$2" . '" target="_blank">$1</a>
            <span class="u-block u-text-mute">
            <small class="u-mr-xsmall">$3</small>           
            </span>
            ', 'ctsubstr(title,60),permalink,formatstatus(time,status),title');

        $this->datatables->add_column('alat', '
            <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="'.base_url('app/site_pages/').'update/$1"><i class="fa fa-edit"></i></a>
            <button data-title="are you sure ?" data-text="want to delete $2" class="c-btn--custom c-btn--small c-btn c-btn--danger action-delete" data-id="$1" data-href="'. base_url('app/site_pages/delete/$1') .'" type="button"><i class="fa fa-trash"></i></button>
            ', 'id,title');   

        $this->datatables->add_column('view', '
          <button type="button" class="c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
          ', 'id'); 

        return $this->datatables->generate();
    } 

    public function data_post(){

        # define post input
        $post_data = array(
            'title' => htmlentities($this->input->post('title')),
            'permalink' => strip_tags($this->input->post('permalink')),
            'time' => date('Y-m-d H:i:s'),
            'content' => htmlentities($this->input->post('content')),
            'status' => strip_tags($this->input->post('status')),            
        );

        /**
         * Check if process update > merge updated data
         */
        if (!empty($this->input->post('id'))) {

            unset($post_data['time']);

            $post_merge = array(
                'updated' => date('Y-m-d H:i:s'),
            );

            $post_data = array_merge($post_data, $post_merge);   
        }     


        /**
         * Set Permalink News if Update
         */
        if (empty($post_data['permalink'])) {
            $permalink_news = strtolower(slug($post_data['title']));
        }else {        
            $permalink_old = strtolower(slug($this->input->post('permalink'."_old")));
            $set_permalink = strtolower(slug($post_data['permalink']));
            $read_pages = $this->_Process_MYSQL->get_data($this->table_site_pages, array('permalink' => $set_permalink))->num_rows();
            if ($read_pages > 0) {
                if ($permalink_old == $set_permalink) {
                    $permalink_news = $set_permalink;                
                }else {
                    $uniqe_string = rand();
                    $permalink_news = $set_permalink."-".$uniqe_string;
                }
            }else {
                $permalink_news = $set_permalink;
            }
        }

        $post_data['permalink'] = $permalink_news;             

        return $post_data;
    }    

    public function required(){

        $pages = $this->db
        ->select("id,title")
        ->from($this->table_site_pages)
        ->where("time <= NOW()")
        ->where("status = 'Published'")
        ->get()->result_array();

        return [
            'pages' => $pages,
        ];
    }    

    public function data_update($id){
        return $this->_Process_MYSQL->get_data($this->table_site_pages,['id' => $id])->row_array();
    }

    public function process_create(){
        return $this->_Process_MYSQL->insert_data($this->table_site_pages,$this->data_post());
    }

    public function process_update(){
        return $this->_Process_MYSQL->update_data($this->table_site_pages,$this->data_post(),['id' => $this->input->post('id')]);
    }   

    public function process_delete($id){
        return $this->_Process_MYSQL->delete_data($this->table_site_pages, array('id' => $id));
    }

    public function process_multiple_update($data){
        return $this->_Process_MYSQL->update_data_multiple($this->table_site_pages, $data, 'id');
    }

    public function process_multiple_delete($id){
        return $this->_Process_MYSQL->delete_data_multiple($this->table_site_pages, $id, 'id');
    }        

}
