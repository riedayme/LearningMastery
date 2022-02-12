<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Blog_Post_Comment extends CI_Model
{
    public $table_blog_post_comment = 'tb_blog_post_comment';
    public $table_blog_post = 'tb_blog_post';    

    public function datatables(){

        return [
            'datatable' => true,
            'datatables_data' => "
            [{'data': 'checkbox',className:'c-table__cell u-pl-small u-pr-small', width:'50'},
            {'data': 'id',className:'c-table__cell'},
            {'data': 'content',className:'c-table__cell u-pl-zero',width:'100%'},
            {'data': 'date',className:'c-table__cell'},
            {'data': 'status',className:'c-table__cell'},                        
            {'data': 'email',className:'c-table__cell'},                                                
            {'data': 'log',className:'c-table__cell'},                                    
            {'data': 'alat',className:'c-table__cell', width:'100'} ]
            ",
        ];
    }

    public function data_table(){

        header('Content-Type: application/json');  

        $this->datatables->select('
            tb_blog_post_comment.id,
            tb_blog_post_comment.id_blog_post,
            tb_blog_post_comment.parent,
            tb_blog_post_comment.name,
            tb_blog_post_comment.email,
            DATE_FORMAT(tb_blog_post_comment.date, "%d %M %Y %H:%i %p") as date,
            tb_blog_post_comment.content,
            tb_blog_post_comment.log,
            tb_blog_post_comment.status,
            tb_blog_post.permalink as permalink,
            tb_blog_post.title as title           
            ');
        $this->datatables->from($this->table_blog_post_comment);
        $this->datatables->join($this->table_blog_post, 'tb_blog_post.id = tb_blog_post_comment.id_blog_post', 'LEFT');

        $this->datatables->add_column('checkbox', '
            <td>
            <div class="c-choice c-choice--checkbox">
            <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
            <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
            </div>
            </td>
            ', 'id');

        $this->datatables->edit_column('content', '
            $4
            <span class="break-word"><small><i class="fa fa-comment u-color-primary"></i></small> $1</span>
            <span class="u-block u-text-mute">
            <small class="u-mr-xsmall">
            <i class="fa fa-globe u-color-primary"></i>&nbsp; <a title="$2" href="' . base_url('blog/post/$3#comment-$6') . '" target="_blank">$2</a>
            </small>
            </span>
            ', 'content,ctsubstr(title,60),permalink,checkparent(name,parent),status,id');


        $this->datatables->edit_column('status', '$1', 'statuscomment(status)');

        $this->datatables->add_column('alat', '
            <button type="button" class="u-mt-small c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
            <button type="button" data-title="are you sure ?" data-text="want to delete $2" class="u-mt-small c-btn c-btn--danger c-btn--custom action-delete" data-href="'. base_url('app/blog_post_comment/delete/$1') .'">
            <i class="fa fa-trash"></i>
            </button>
            ', 'id,name');
        return $this->datatables->generate();
    }  

    public function process_delete($id){
        return $this->_Process_MYSQL->delete_data($this->table_blog_post_comment, array('id' => $id));
    }

    public function process_multiple_update($data){
        return $this->_Process_MYSQL->update_data_multiple($this->table_blog_post_comment, $data, 'id');
    }    

    public function process_multiple_delete($id){
        return $this->_Process_MYSQL->delete_data_multiple($this->table_blog_post_comment, $id, 'id');
    }    

}