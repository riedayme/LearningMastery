<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class to handle job execution
 * https://medium.com/@gustavo.uach/how-to-build-a-simple-job-server-in-codeigniter-712d979940d8
 */
class My_jobs extends My_Site
{
	const STATUS_DONE = 'done';
	const STATUS_QUEUED = 'queued';
	const STATUS_RUNNING = 'running';

	protected $dbm;
	protected $cfg;

	/**
	 * Constructs the class
	 */
	public function __construct()
	{
		parent::__construct();

		if (php_sapi_name() !== 'cli')
		{
			die('No direct script access allowed');
		}
	}

	/**
	 * Listener to process jobs
	 */
	public function listen()
	{

		$job = $this->db->query("
			SELECT id, name, payload
			FROM tb_jobs
			WHERE status=?
			ORDER BY created ASC
			LIMIT 1 FOR UPDATE", [self::STATUS_QUEUED])->result();

		if ($job !== [])
		{
			$job = $job[0];

			echo "\nProcessing job " . $job->id . "\n";

			if (!method_exists($this, $job->name))
			{
				throw new \RuntimeException('Job ' . $job->name . ' not found');
				exit;
			}

			try
			{
				$start = microtime(true);
				$runtime = null;

				$this->db->query("UPDATE tb_jobs SET status=? WHERE id=?", [self::STATUS_RUNNING, $job->id]);

				$jobHandler = [$this, $job->name];

				$payload = json_decode($job->payload, true);

				if (!is_array($payload))
				{
					throw new \InvalidArgumentException('Invalid payload format');
				}

				$payload = is_array($payload) ? $payload : [];

				$runtime = microtime(true) - $start;
				$response = $jobHandler($payload);
			}
			catch (\Exception $e)
			{
				$runtime = $runtime === null ?  microtime(true) - $start : $runtime;
				$response = $e->getMessage();
			}

			$this->db->query("UPDATE tb_jobs SET status=?, run_time=?, response=? WHERE id=?", [
				self::STATUS_DONE,
				$runtime,
				$response,
				$job->id,
				]);

			echo "Job $job->id finished. \n";
		}
	}

	/**
	 * Send an email job
	 * @param  array  $payload  Payload of the job
	 * @return array ['sent' => 1|0]
	 */
	public function sendEmail(array $payload) : string
	{

		if (!isset($payload['to']))
		{
			throw new \InvalidArgumentException('Invalid to');
		}

		if (!isset($payload['subject']))
		{
			throw new \InvalidArgumentException('Invalid subject');
		}				

		if (!isset($payload['message']))
		{
			throw new \InvalidArgumentException('Invalid message');
		}		

		$from_email = $this->site['smtp']['smtp_user']; 
		$to_email = $payload['to']; 
		$subject =  $payload['subject']; 
		$message = $payload['message'];

		$config = Array(
			'protocol' => $this->site['smtp']['protocol'], /*  'mail', 'sendmail', or 'smtp' */
			'smtp_host' => $this->site['smtp']['smtp_host'],
			'smtp_port' => $this->site['smtp']['smtp_port'],
			'smtp_user' => $this->site['smtp']['smtp_user'],
			'smtp_pass' => $this->site['smtp']['smtp_pass'],
			'smtp_crypto' => 'ssl', /* can be 'ssl' or 'tls' for example */
			'mailtype'  => 'html', /* plaintext 'text' mails or 'html' */
            //'smtp_timeout' => '4', /*in seconds*/
			'charset'   => 'iso-8859-1'
            //'wordwrap' => TRUE
			);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");   

		$this->email->from($from_email,$this->site['title']);  
		$this->email->to($to_email);
		$this->email->subject($subject); 
		$this->email->message($message); 

		if($this->email->send()){
			return 'success';
		}else {
			return 'failed';
		} 

	}  	
}