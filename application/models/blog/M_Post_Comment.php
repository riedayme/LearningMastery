<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_Post_Comment extends CI_Model {

	public $table_blog_post_comment = 'tb_blog_post_comment';	

	public function disqus($site){
		$disqus = "
		<div id='disqus_thread'></div>
		<script type='text/javascript'> var disqus_developer = ".$site['blog_comment']['disqus_developer']."; var disqus_shortname = '".$site['blog_comment']['disqus_shortname']."'; var disqus_url = '" . current_url() . "'; /* * * DON'T EDIT BELOW THIS LINE * * */ (function() {var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true; dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); })(); </script> 
		<script id='dsq-count-scr' src='//".$site['blog_comment']['disqus_shortname'].".disqus.com/count.js' async></script>
		<noscript>Please enable JavaScript to view the <a href='//disqus.com/?ref_noscript'>comments powered by Disqus.</a></noscript> 
		<a href='//disqus.com' class='dsq-brlink'>blog comments powered by <span class='logo-disqus'>Disqus</span></a>
		";
		return [
			'comment_post' => [
				'type' => $site['blog_comment']['type'],
				'data' => $disqus
			]
		];
	}

	public function system($site,$id_post){

		$comments = $this->read_comments($site,$id_post);


		$data['comment_post'] = $comments;
		$data['comment_post']['type'] = $site['blog_comment']['type']; 
		
		return $data;
	}

	public function read_comments($site,$id_post)
	{

		$comments_count = $this->comments_count($id_post);

		$read_parent = $this->db->select("*")
		->from($this->table_blog_post_comment)
		->where("tb_blog_post_comment.id_blog_post",$id_post)
		->where("tb_blog_post_comment.status != 'Pending'")                        
		->where("tb_blog_post_comment.parent", "")        
		->get()->result();  

		if (!empty($read_parent)) {

			$comment_data = array(
				'count' => $comments_count,
			);

			foreach ($read_parent as $comment) {

				if ($comment->status == 'Blocked') {
					$content = $site['blog_comment']['message'];
				}else {
					$content = $comment->content;
				}

				$comment_parent = array(
					'id' => $comment->id,
					'name' => $comment->name,
					'date' => date('d F Y H:i A', strtotime($comment->date)),
					'content' => $content,
					'status' => $comment->status,                                            
				);

				$read_child = $this->db->select("*")
				->from($this->table_blog_post_comment)
				->where("tb_blog_post_comment.id_blog_post",$id_post)
				->where("tb_blog_post_comment.status != 'Pending'")                
				->where("tb_blog_post_comment.parent", $comment->id)        
				->get()->result();  

				foreach ($read_child as $comment_child) {

					if ($comment_child->status == 'Blocked') {
						$content = $site['blog_comment']['message'];
					}else {
						$content = $comment_child->content;
					}

					$comment_child_data[] = array(
						'id' => $comment_child->id,
						'name' => $comment_child->name,
						'date' => date('d F Y H:i A', strtotime($comment_child->date)),						
						'content' => $content, 
						'status' => $comment_child->status,                                              
					);

					$data_merge = array(
						'child' => $comment_child_data,
					);

					$comment_parent = array_merge($comment_parent,$data_merge);

				}

				$comment_data['data'][] = array(
					$comment_parent
				);

				unset($comment_child_data);
			}

			return $comment_data;
		}else {
			return false;
		}


	}

	public function comments_count($id_post)
	{
		$read_comment = $this->db->select("*")
		->from($this->table_blog_post_comment)
		->where("tb_blog_post_comment.id_blog_post",$id_post)
		->where("tb_blog_post_comment.status != 'Pending'")         
		->get()->num_rows();  

		return $read_comment;
	}	

	public function post_comment($site)
	{

		$this->load->library('user_agent');
		$this->load->model('site/M_Site_Visitor');

		$log =  array(
			'ip' => $this->input->ip_address(),
			'browser' => $this->M_Site_Visitor->get_browser(),
			'os' => $this->M_Site_Visitor->get_platform(),
		);

		$status = ($site['blog_comment']['moderate'] == "true") ? 'Pending' : 'Approved';

		$post_data = array(
			'id_blog_post' => htmlentities($this->input->post('id_blog_post')),
			'parent' => htmlentities($this->input->post('parent')),
			'name' => htmlentities($this->input->post('name')),
			'email' => htmlentities($this->input->post('email')),                
			'date' => date('Y-m-d H:i:s'),
			'content' => htmlentities($this->input->post('content')),    
			'log' => json_encode($log),
			'status' => $status,
			'status_read' => 'Unread'
		);

		$csrf_code = $this->input->post('csrf_code');

		if ($csrf_code != '' AND $this->session->userdata('csrf_code') == $csrf_code) {        

			if ($this->_Process_MYSQL->insert_data($this->table_blog_post_comment, $post_data) == true) {

				if ($site['blog_comment']['moderate'] == "true") {
					$this->session->set_flashdata('comment', 'success_pending');

					redirect(uri_string()."#form-comment");
				}else {

					$this->session->set_flashdata('comment', 'success_approved');

					$read = $this->_Process_MYSQL->get_data($this->table_blog_post_comment, array('date' => $post_data['date']))->row_array();

					redirect(uri_string()."#comment-".$read['id']);                    
				}

			} else {

				$this->session->set_flashdata('comment', 'failed');

				redirect(uri_string()."#form-comment");
			}
		}else {

			$this->session->set_flashdata('comment', 'failed');

			redirect(uri_string()."#form-comment");
		}


	}   

}