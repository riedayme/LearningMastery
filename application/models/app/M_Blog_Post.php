<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Blog_Post extends CI_Model
{

    public $table_blog_post = 'tb_blog_post';
    public $table_blog_post_category = 'tb_blog_post_category';
    public $table_blog_post_tags = 'tb_blog_post_tags';
    public $table_blog_post_comment = 'tb_blog_post_comment';

    public function datatables(){
        return [
        'datatable' => true,
        'datatables_data' => "
        [{'data': 'checkbox',className:'c-table__cell u-pl-small'},
        {'data': 'id',className:'c-table__cell'},
        {'data': 'title',className:'c-table__cell u-pl-small',width:'100%'},
        {'data': 'category',className:'c-table__cell u-text-center'},
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

        /** disable because long process **/
        // GROUP_CONCAT(DISTINCT tb_blog_post_tags.name ORDER BY tb_blog_post_tags.name ASC) as bpt_name,   
        // $this->datatables->join($this->table_blog_post_tags, 'FIND_IN_SET(tb_blog_post_tags.id,tb_blog_post.id_tags) > 0', 'LEFT OUTER');

        $this->datatables->select('
            tb_blog_post.id,
            tb_blog_post.title,
            DATE_FORMAT(tb_blog_post.time, "%d %M %Y %H:%i %p") as time,
            tb_blog_post.time as timeorigin,
            DATE_FORMAT(tb_blog_post.updated, "%d %M %Y %H:%i %p") as updated,            
            tb_blog_post.permalink,
            tb_blog_post.views,
            tb_blog_post.status,
            tb_blog_post_category.name as category,
            GROUP_CONCAT(DISTINCT tb_blog_post_comment.id) as comments,  
            ');
        $this->datatables->from($this->table_blog_post);
        $this->datatables->join($this->table_blog_post_category, 'tb_blog_post.id_category = tb_blog_post_category.id', 'LEFT');
        $this->datatables->join($this->table_blog_post_comment, 'tb_blog_post_comment.id_blog_post = tb_blog_post.id', 'LEFT');
        $this->datatables->group_by('tb_blog_post.id');
        $this->datatables->add_column('checkbox', '
            <td>
                <div class="c-choice c-choice--checkbox">
                    <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
                    <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
                </div>
            </td>
            ', 'id');

        $this->datatables->edit_column('title', '
            <a title="$1" href="' . base_url('blog-post/') ."$2" . '" target="_blank">$1</a>
            <span class="u-block u-text-mute">
                $3
                <small class="u-mr-xsmall"><i class="fa fa-eye u-color-warning"></i>&nbsp; $4</small>
                <small class="u-mr-xsmall"><i class="fa fa-comment u-color-info"></i>&nbsp; $5</small>            
            </span>
            ', 'ctsubstr(title,60),permalink,formatstatus(timeorigin,status),views,countcomment(comments)');
        $this->datatables->edit_column('category', '$1', 'ucwords(category)');

        $this->datatables->add_column('alat', '
            <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="'.base_url('app/blog_post/').'update/$1"><i class="fa fa-edit"></i></a>
            <button type="button" data-title="are you sure ?" data-text="want to delete $2" class="c-btn c-btn--danger c-btn--custom action-delete" data-href="'. base_url('app/blog_post/delete/$1') .'">
                <i class="fa fa-trash"></i>
            </button>
            ', 'id,title');

        $this->datatables->add_column('view', '
          <button type="button" class="c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
          ', 'id');         

        return $this->datatables->generate();
    }

    public function required($withpost = false){

        $data = [
        'categorys' => $this->_Process_MYSQL->read_data($this->table_blog_post_category, 'id', 'DESC')->result_array(),
        'tags' => $this->_Process_MYSQL->read_data($this->table_blog_post_tags, 'id', 'DESC')->result_array(),
        ];

        if ($withpost) {

            $post = $this->db
            ->select("id,title")
            ->from($this->table_blog_post)
            ->where("time <= NOW()")
            ->where("status = 'Published'")
            ->get()->result_array();

            $data = array_merge($data,['post' => $post]);
        }

        return $data;
    }

    public function data_post(){

        $post_data = [
        'title' => htmlentities($this->input->post('title')),
        'image' => htmlentities($this->input->post('image')),
        'permalink' => $this->input->post('permalink'),
        'time' => htmlentities($this->input->post('time')),
        'id_category' => $this->input->post('id_category'),
        'id_tags' => $this->input->post('id_tags'),
        'content' => htmlentities($this->input->post('content')),
        'description' => htmlentities($this->input->post('description')),                        
        'status' => strip_tags($this->input->post('status')),            
        ];

        /**
         * Check if process update > merge updated data
         */
        if (!empty($this->input->post('id'))) {

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

            if ($permalink_old == $set_permalink) {
                $permalink_news = $set_permalink;                
            }else {

                $read_post = $this->_Process_MYSQL->get_data($this->table_blog_post, array('permalink' => $set_permalink))->num_rows();
                if ($read_post > 0) {
                    $uniqe_string = rand();
                    $permalink_news = $set_permalink."-".$uniqe_string;
                }else {
                    $permalink_news = $set_permalink;
                }
            }
        }

        $post_data['permalink'] = $permalink_news;         


        /**
         * Check if Have new category
         */
        $category_old = strtolower($this->input->post('id_category_old'));                    
        if (empty($post_data['id_category'])) {
            $category_news = false;

            if (!empty($category_old)) {
                if ($this->check_category($category_old)  < 2) {
                    $this->delete_category($category_old);
                } 
            }

        }else{


            $category = strtolower($post_data['id_category']);

            /**
             * process check category news or old
             */

            $read_category = $this->db
            ->from($this->table_blog_post_category)
            ->where('id', $category)
            ->or_where('name', $category)
            ->get();

            if ($read_category->num_rows() > 0) {

                if ($category != $category_old) {
                    /**
                     * process delete old category if not exist on other post
                     */
                    if ($this->check_category($category_old)  < 2) {
                        $this->delete_category($category_old);
                    }                              
                }

                $category_news = $read_category->row()->id;
            } else {

                /**
                 * process delete old category if not exist on other post
                 */
                if ($this->check_category($category_old)  < 2) {
                    $this->delete_category($category_old);
                }          

                $data_category = array(
                    'name' => $category,
                    'slug' => slug($category),
                    );

                if ($this->_Process_MYSQL->insert_data($this->table_blog_post_category, $data_category)) {

                    $read_category = $this->_Process_MYSQL->get_data($this->table_blog_post_category, array('name' => $category))->row();

                    $category_news = $read_category->id;

                } else {
                    # failed insert new category
                }
            }           
        }

        $post_data['id_category'] = $category_news; 


        /**
         * Process check new tags
         */
        $tags_post_old = (!empty($this->input->post('id_tags_old'))) ? explode(',',$this->input->post('id_tags_old')) : false;     
        if (empty($post_data['id_tags'])) {

            $post_data['id_tags'] = false;

            if ($tags_post_old) {
                $tags_delete = $tags_post_old;
                if (!empty($tags_delete)) {
                    foreach ($tags_delete as $tag_old) {
                        if ($this->check_tags($tag_old)  < 2) {
                            $this->delete_tags($tag_old);
                        }
                    }
                }
            }
        }else{

            $tags_post = array_map('strtolower', $post_data['id_tags']);

            $read_tags = $this->db
            ->from($this->table_blog_post_tags)
            ->where_in('id', $tags_post)
            ->or_where_in('name', $tags_post)
            ->get();

            # read data and set to array data
            foreach ($read_tags->result() as $tag) {
                $tags[] = $tag->id;
                $tags[] = $tag->name;
                $tags_insert[] = $tag->id;
            }

            # check if tags exist, remove same value and get new tags
            if (!empty($tags)) {
                $tags_news = array_diff(array_unique($tags_post), $tags);
            } else {
                $tags_news = array_unique($tags_post);
            }  

            # check if tags_news $tags_news exist
            if (count($tags_news) > 0) {

                # build data for new tag
                foreach ($tags_news as $name) {
                    $post_tags[] = array(
                        'name' => strtolower($name),
                        'slug' => strtolower(slug($name)),
                        );
                }

                # insert all new tag
                if ($this->_Process_MYSQL->insert_data_multiple($this->table_blog_post_tags, $post_tags, 'true')) {

                    # read id after insert
                    $read_tags = $this->_Process_MYSQL->get_data_multiple($this->table_blog_post_tags, $tags_news, 'name')->result();

                    # create id for insert post
                    foreach ($read_tags as $data_tags) {
                        $tags_id[] = $data_tags->id;
                    }

                    # check if add tag insert, join new tag and old tag
                    if (!empty($tags_insert)) {
                        $all_tags = array_merge($tags_id, $tags_insert);
                    } else {
                        $all_tags = $tags_id;
                    }

                    # set value post data tags
                    $post_data['id_tags'] = implode(',', $all_tags);

                } else {
                    #failed insert category
                }


            } else {

                foreach ($read_tags->result() as $tags_im) {
                    $implode_tags[] = $tags_im->id;
                }

                $post_data['id_tags'] = implode(',',$implode_tags); 
            }

            /** start dynamic tags **/
            if ($tags_post_old) {

                $tags_delete = array_diff($tags_post_old, explode(',', $post_data['id_tags']));

                if (!empty($tags_delete)) {

                    foreach ($tags_delete as $tag_old) {
                        if ($this->check_tags($tag_old)  < 2) {
                            $this->delete_tags($tag_old);
                        }
                    }
                }
            }

            /** end **/
        }

        return $post_data;        
    }

    public function data_update($id){
        return $this->_Process_MYSQL->get_data($this->table_blog_post,['id' => $id])->row_array();
    }

    public function process_create(){
        // for ($i=0; $i < 100 ; $i++) { 
        //     $this->_Process_MYSQL->insert_data($this->table_blog_post,$this->data_post());
        // }
        return $this->_Process_MYSQL->insert_data($this->table_blog_post,$this->data_post());
    }

    public function process_update(){
        return $this->_Process_MYSQL->update_data($this->table_blog_post,$this->data_post(),['id' => $this->input->post('id')]);
    }   

    /**
     * Delete Blog Post
     * Delete Blog Post Comment
     */
    public function process_delete($id){

        $read = $this->data_update($id);
        $category = $read['id_category'];
        $tags = explode(',', $read['id_tags']);

        foreach ($tags as $tag) {
            if ($this->check_tags($tag)  < 2) {
                $this->delete_tags($tag);
            }
        }

        if ($this->check_category($category)  < 2) {
            $this->delete_category($category);
        }

        if ($this->_Process_MYSQL->delete_data($this->table_blog_post, array('id' => $id)) == true AND $this->_Process_MYSQL->delete_data($this->table_blog_post_comment, array('id_blog_post' => $id)) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function process_multiple_update($data){
        return $this->_Process_MYSQL->update_data_multiple($this->table_blog_post, $data, 'id');
    }

    /**
     * Delete Blog Post
     * Delete Blog Post Comment
     */
    public function process_multiple_delete($id){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_blog_post, $id, 'id');
        $count_read = $read->num_rows();

        foreach ($read->result_array() as $post) {

            $category_delete[$post['id_category']][] = true;
            $category = $post['id_category'];

            $tags = explode(',', $post['id_tags']);

            foreach ($tags as $tag) {
                $tag_delete[$tag][] = true;
                if ($this->check_tags($tag)  < 2 OR $this->check_tags($tag) == count($tag_delete[$tag])) {
                    $this->delete_tags($tag);
                }
            }

            if ($this->check_category($category)  < 2 OR $this->check_category($category) == count($category_delete[$post['id_category']])) {
                $this->delete_category($category);
            }
        }

        if ($this->_Process_MYSQL->delete_data_multiple($this->table_blog_post, $id, 'id') == true AND $this->_Process_MYSQL->delete_data_multiple($this->table_blog_post_comment, $id, 'id_blog_post') == true) {
            echo true;
        } else {
            echo false;
        }
    }    


    /**
     * Logic Category
     */
    public function check_category($id){
        return $this->_Process_MYSQL->get_data($this->table_blog_post,['id_category' => $id])->num_rows();
    }

    public function delete_category($id){
        return $this->_Process_MYSQL->delete_data($this->table_blog_post_category, array('id' => $id));
    }

    /**
     * Logic Tags
     */
    public function check_tags($id){

        $tags = $this->db
        ->from($this->table_blog_post)
        ->where('FIND_IN_SET('.$id.', id_tags)')
        ->get()->num_rows();

        return $tags;
    }

    public function delete_tags($id){
        return $this->_Process_MYSQL->delete_data($this->table_blog_post_tags, array('id' => $id));
    }    

}